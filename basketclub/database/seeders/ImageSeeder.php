<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asignar imagenes a players
        Player::all()->each(function (Player $player) {
            $player->image()->create(
                Image::factory()->make()->toArray()
            );
        });

        // Asignar imagenes a teams
        Team::all()->each(function (Team $team) {
            $team->image()->create(
                Image::factory()->make()->toArray()
            );
        });
    }
}
