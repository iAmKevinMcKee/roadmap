<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Kevin McKee',
            'email' => 'kevin@padmission.com',
            'is_admin' => true,
        ]);

        Feature::factory(10)->create();
    }
}
