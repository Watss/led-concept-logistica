<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('client.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();
        return view('client.create',compact('client'));
    }

    /**
     * @param \App\Http\Requests\ClientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->validated());

        return redirect()->route('client.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Client $client)
    {
        return view('client.edit', compact('client'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        return redirect()->route('client.index');
    }
}
