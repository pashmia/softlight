<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\StatusSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@admin.ru',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            CategorySeeder::class,
            CountrySeeder::class,
            StatusSeeder::class,
        ]);
    }
}
