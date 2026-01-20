<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
 use RefreshDatabase;

    /**
     * Test sobre el endpoint /teams
     */
    public function test_index_TeamController_getTeams_ReturnStatus200(): void
    {
        $version = env('APP_VER', 'v1');
        $response = $this->get("/{$version}/teams");
        $response->assertStatus(200);
    }

    /**
     * Test sobre el endpoint /teams
     */
    public function test_index_TeamController_getTeams(): void
    {
        $teams = Team::factory()->count(5)->create();

        $version = env('APP_VER', 'v1');
        $response = $this->get("/{$version}/teams");
        $response->assertStatus(200)
                ->assertJsonCount(count: 5);
    }

    /**
     * Test sobre el endpoint GET /teams/{id}
     */
    public function test_show_TeamController_getTeamById(): void
    {
        $team = Team::factory()->create();

        $version = env('APP_VER', 'v1');
        $response = $this->get("/{$version}/teams/{$team->id}");
        $response->assertStatus(200)
                ->assertJson([
                    'id' => $team->id,
                    'name' => $team->name,
                    'category' => $team->category,
                ]);
    }

    /**
     * Test sobre el endpoint POST /teams/{id} ERROR
     */
    public function test_store_error_TeamController_postTeam(): void
    {
        $team = [
            'name' => 'Testeam',
            'category' => 'Junior',
            'gender' => 'Female',
        ];

        $version = env('APP_VER', 'v1');
        $response = $this->postJson("/{$version}/teams", $team);
        $response->assertStatus(422);
    }

    /**
     * Test sobre el endpoint POST /teams/{id} CORRECTO
     */
    public function test_store_TeamController_postTeam(): void
    {
        $team = [
            'name' => 'Team 2',
            'category' => 'Junior',
            'gender' => 'Female'
        ];

        $version = env('APP_VER', 'v1');
        $response = $this->postJson("/{$version}/teams", $team);
        $response->assertStatus(201)
                ->assertJsonFragment([
                    'name' => $team['first_name'],
                    'category' => $team['category']
                ]);
    }
}
