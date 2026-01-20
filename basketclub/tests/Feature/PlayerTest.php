<?php

namespace Tests\Feature;

use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test sobre el endpoint /players
     */
    public function test_index_PlayerController_getPlayers_ReturnStatus200(): void
    {
        $version = env('APP_VER', 'v1');
        $response = $this->get("/{$version}/players");
        $response->assertStatus(200);
    }

    /**
     * Test sobre el endpoint /players
     */
    public function test_index_PlayerController_getPlayers(): void
    {
        $players = Player::factory()->count(5)->create();

        $version = env('APP_VER', 'v1');
        $response = $this->get("/{$version}/players");
        $response->assertStatus(200)
                ->assertJsonCount(count: 5);
    }

    /**
     * Test sobre el endpoint GET /players/{id}
     */
    public function test_show_PlayerController_getPlayerById(): void
    {
        $player = Player::factory()->create();

        $version = env('APP_VER', 'v1');
        $response = $this->get("/{$version}/players/{$player->id}");
        $response->assertStatus(200)
                ->assertJson([
                    'id' => $player->id,
                    'first_name' => $player->first_name,
                    'last_name' => $player->last_name,
                ]);
    }

    /**
     * Test sobre el endpoint POST /players/{id} ERROR
     */
    public function test_store_error_PlayerController_postPlayer(): void
    {
        $player = [
            'first_name' => 'Elsa',
            'last_name' => 'Pato',
            'date_birth' => '2000-01-01',
        ];

        $version = env('APP_VER', 'v1');
        $response = $this->postJson("/{$version}/players", $player);
        $response->assertStatus(422);
    }

    /**
     * Test sobre el endpoint POST /players/{id} CORRECTO
     */
    public function test_store_PlayerController_postPlayer(): void
    {
        $player = [
            'first_name' => 'Elsa',
            'last_name' => 'Pato',
            'date_birth' => '2000-01-01',
            'gender' => 'Female'
        ];

        $version = env('APP_VER', 'v1');
        $response = $this->postJson("/{$version}/players", $player);
        $response->assertStatus(201)
                ->assertJsonFragment([
                    'first_name' => $player['first_name'],
                    'date_birth' => $player['date_birth']
                ]);
    }
}
