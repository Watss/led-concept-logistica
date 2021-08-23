<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Alert;

class ClientController extends Controller
{
    public function __construct()
    {
       $this->middleware(['role:Vendedor|Administrador'])->except('index');
    }

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
        $this->authorize('create',$client);
        return view('client.create',compact('client'));
    }

    /**
     * @param \App\Http\Requests\ClientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $this->authorize('create',new Client());
        $client = Client::create($request->validated());
        Alert::success('Cliente Guardado', '');
        return redirect()->route('clients.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Client $client)
    {
        $this->authorize('edit',$client);
        return view('client.create', compact('client'));
    }

    public function update(ClientStoreRequest $request, Client $client){

        $this->authorize($client);
        $client->update($request->validated());
        Alert::success('Actualizado Correctamente');
        return redirect()->route('clients.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        $this->authorize($client);
        $client->delete();

        return redirect()->route('client.index');
    }
}
