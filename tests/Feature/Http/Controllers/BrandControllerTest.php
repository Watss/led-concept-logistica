<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BrandController
 */
class BrandControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $brands = Brand::factory()->count(3)->create();

        $response = $this->get(route('brand.index'));

        $response->assertOk();
        $response->assertViewIs('brand.index');
        $response->assertViewHas('budgets');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('brand.create'));

        $response->assertOk();
        $response->assertViewIs('brand.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BrandController::class,
            'store',
            \App\Http\Requests\BrandStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('brand.store'), [
            'name' => $name,
        ]);

        $brands = Brand::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $brands);
        $brand = $brands->first();

        $response->assertRedirect(route('brand.index'));
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brand.edit', $brand));

        $response->assertOk();
        $response->assertViewIs('brand.edit');
        $response->assertViewHas('brand');
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $brand = Brand::factory()->create();

        $response = $this->delete(route('brand.destroy', $brand));

        $response->assertRedirect(route('brand.index'));

        $this->assertDeleted($brand);
    }
}
