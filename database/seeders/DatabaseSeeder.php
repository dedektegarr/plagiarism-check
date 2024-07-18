<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'id' => Str::uuid(),
            'name' => 'Dedek Tegar Apriyandi',
            'username' => 'g1f020027',
            'password' => bcrypt('0nc0m12345')
        ]);
    }
}
