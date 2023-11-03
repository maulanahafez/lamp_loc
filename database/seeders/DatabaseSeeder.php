<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\Report;
use App\Models\Streetlight;
use App\Models\StreetlightGroup;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'email' => 'admin@admin',
            'password' => '123123123'
        ]);

        StreetlightGroup::factory()->count(5)->create();
        $groups = StreetlightGroup::all();
        foreach ($groups as $g) {
            for ($i = 1; $i <= 10; $i++) {
                Streetlight::factory()->count(1)->state([
                    'streetlight_group_id' => $g->id,
                    'order' => $i,
                ])->has(Report::factory()->count(2))->has(Image::factory()->count(2))->create();
            }
        }
        // Streetlight::factory()->count(100)->has(Report::factory()->count(2))->has(Image::factory()->count(2))->create();
    }
}
