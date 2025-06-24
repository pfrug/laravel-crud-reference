<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Country;
use App\Models\ClientGroup;
use App\Models\PaymentTerm;
use App\Models\SalesRep;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ClientCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $token = Auth::guard('api')->login($user);
        $this->withHeader('Authorization', 'Bearer ' . $token);
    }

    protected function createDependencies()
    {
        return [
            'country_id' => Country::factory()->create()->id,
            'client_group_id' => ClientGroup::factory()->create()->id,
            'payment_term_id' => PaymentTerm::factory()->create()->id,
            'sales_rep_id' => SalesRep::factory()->create()->id,
        ];
    }

    public function test_can_list_clients()
    {
        $this->authenticate();
        $dependencies = $this->createDependencies();
        Client::factory()->count(3)->create($dependencies);

        $response = $this->getJson('/api/clients');
        $response->assertStatus(200);
    }

    public function test_can_create_client()
    {
        $this->authenticate();
        $data = array_merge([
            'name' => 'Test Client',
            'email' => 'client@example.com',
        ], $this->createDependencies());

        $response = $this->postJson('/api/clients', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Test Client']);
    }

    public function test_can_show_client()
    {
        $this->authenticate();
        $dependencies = $this->createDependencies();
        $client = Client::factory()->create($dependencies);

        $response = $this->getJson("/api/clients/{$client->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $client->id]);
    }

    public function test_can_update_client(): void
    {
        $this->authenticate();
        $dependencies = $this->createDependencies();
        $client = Client::factory()->create($dependencies);

        $data = array_merge($dependencies, ['name' => 'Updated Name']);

        $response = $this->putJson("/api/clients/{$client->id}", $data);
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);
    }

    public function test_can_patch_client(): void
    {
        $this->authenticate();
        $dependencies = $this->createDependencies();
        $client = Client::factory()->create($dependencies);

        $patchData = ['description' => 'Just a patch test'];

        $response = $this->patchJson("/api/clients/{$client->id}", $patchData);
        $response->assertStatus(200)
                 ->assertJsonFragment(['description' => 'Just a patch test']);
    }

    public function test_can_delete_client()
    {
        $this->authenticate();
        $dependencies = $this->createDependencies();
        $client = Client::factory()->create($dependencies);

        $response = $this->deleteJson("/api/clients/{$client->id}");
        $response->assertStatus(204);
    }
}
