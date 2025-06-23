<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with(['country', 'paymentTerm', 'clientGroup', 'salesRep'])->paginate(15);
        return ClientResource::collection($clients);
    }

    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->validated());
        return new ClientResource($client->load(['country', 'paymentTerm', 'clientGroup', 'salesRep']));
    }

    public function show(Client $client)
    {
        return new ClientResource($client->load(['country', 'paymentTerm', 'clientGroup', 'salesRep']));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return new ClientResource($client->load(['country', 'paymentTerm', 'clientGroup', 'salesRep']));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
