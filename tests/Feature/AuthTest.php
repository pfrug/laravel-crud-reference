<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => 'secret123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'access_token',
                     'token_type',
                     'expires_in'
                 ]);
    }

    #[Test]
    public function user_cannot_login_with_invalid_credentials()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('correctpassword'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'error' => 'Unauthorized'
                 ]);
    }

    #[Test]
    public function unauthenticated_user_cannot_access_protected_routes()
    {
        $response = $this->get('/api/me', ['Accept' => 'application/json']);

        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Unauthenticated.'
                 ]);
    }

    #[Test]
    public function authenticated_user_can_access_me_route()
    {
        $user = User::factory()->create();
        $token = Auth::guard('api')->login($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->getJson('/api/me');

        $response->assertStatus(200)
                 ->assertJson([
                     'email' => $user->email
                 ]);
    }

    #[Test]
    public function user_can_logout()
    {
        $user = User::factory()->create();
        $token = Auth::guard('api')->login($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Successfully logged out'
                 ]);
    }
}
