<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClientController
 */
class ClientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $clients = Client::factory()->count(3)->create();

        $response = $this->get(route('client.index'));

        $response->assertOk();
        $response->assertViewIs('client.index');
        $response->assertViewHas('budgets');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('client.create'));

        $response->assertOk();
        $response->assertViewIs('client.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClientController::class,
            'store',
            \App\Http\Requests\ClientStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $rut = $this->faker->word;

        $response = $this->post(route('client.store'), [
            'name' => $name,
            'rut' => $rut,
        ]);

        $clients = Client::query()
            ->where('name', $name)
            ->where('rut', $rut)
            ->get();
        $this->assertCount(1, $clients);
        $client = $clients->first();

        $response->assertRedirect(route('client.index'));
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $client = Client::factory()->create();

        $response = $this->get(route('client.edit', $client));

        $response->assertOk();
        $response->assertViewIs('client.edit');
        $response->assertViewHas('client');
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $client = Client::factory()->create();

        $response = $this->delete(route('client.destroy', $client));

        $response->assertRedirect(route('client.index'));

        $this->assertDeleted($client);
    }
}
