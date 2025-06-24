<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    public function __construct(protected ClientService $clientService)
    {
    }

    public function index(): JsonResponse
    {
        try {
            $clients = $this->clientService->listClients();
            return response()->json(ClientResource::collection($clients));
        } catch (\Throwable $e) {
            Log::error('Failed to fetch clients', ['exception' => $e]);
            return response()->json(['message' => 'Failed to fetch clients'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreClientRequest $request): JsonResponse
    {
        try {
            $client = $this->clientService->createClient($request->validated());
            return response()->json(new ClientResource($client), Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            Log::error('Failed to create client', ['exception' => $e]);
            return response()->json(['message' => 'Failed to create client'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Client $client): JsonResponse
    {
        try {
            $client = $this->clientService->getClient($client->id);
            return response()->json(new ClientResource($client));
        } catch (\Throwable $e) {
            Log::error('Failed to fetch client', ['exception' => $e]);
            return response()->json(['message' => 'Failed to fetch client'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateClientRequest $request, Client $client): JsonResponse
    {
        try {
            $client = $this->clientService->updateClient($client, $request->validated());
            return response()->json(new ClientResource($client));
        } catch (\Throwable $e) {
            Log::error('Failed to update client', ['exception' => $e]);
            return response()->json(['message' => 'Failed to update client'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function patch(PatchClientRequest $request, Client $client)
    {
        try {
            $client = $this->clientService->updateClient($client, $request->validated());
            return response()->json(new ClientResource($client));
        } catch (\Throwable $e) {
            Log::error('Failed to update client', ['exception' => $e]);
            return response()->json(['message' => 'Failed to update client'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Client $client): JsonResponse
    {
        try {
            $this->clientService->deleteClient($client);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            Log::error('Failed to delete client', ['exception' => $e]);
            return response()->json(['message' => 'Failed to delete client'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
