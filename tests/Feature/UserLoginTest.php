<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Sikeres bejelentkezés
     */
    public function test_login_successful()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->postJson('/api/users/login', [
            'email' => 'test@example.com',
            'password' => 'secret123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['user' => ['id', 'email', 'token']]);
    }

    /**
     * Sikertelen bejelentkezés
     */
    public function test_login_fails_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('secret123')
        ]);

        $response = $this->postJson('/api/users/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpass'
        ]);

        $response->assertStatus(401)
            ->assertJsonFragment(['message' => 'Invalid email or password!']);
    }
}
