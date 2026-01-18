<?php

namespace Tests\Feature;

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
}
