<?php

namespace App\Services;

use App\Events\ClientCreated;
use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientService
{
    public function listClients(int $perPage = 15)
    {
        return Client::with(['country', 'paymentTerm', 'clientGroup', 'salesRep'])->paginate($perPage);
    }

    public function createClient(array $data): Client
    {
        $client = Client::create($data)->load(['country', 'paymentTerm', 'clientGroup', 'salesRep']);

        event(new ClientCreated($client));
        return $client;
    }

    public function getClient(int $id): Client
    {
        $client = Client::with(['country', 'paymentTerm', 'clientGroup', 'salesRep'])->find($id);

        if (!$client) {
            throw new ModelNotFoundException("Client with ID {$id} not found.");
        }

        return $client;
    }

    public function updateClient(Client $client, array $data): Client
    {
        $client->update($data);
        return $client->load(['country', 'paymentTerm', 'clientGroup', 'salesRep']);
    }

    public function deleteClient(Client $client): void
    {
        $client->delete();
    }
}
