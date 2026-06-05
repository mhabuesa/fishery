<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            PurposeSeeder::class,
        ]);

        User::updateOrCreate(
            ['phone' => '01706944396'],
            [
                'name' => 'Abu Esa',
                'password' => bcrypt('Pa$$w0rd!'),
            ]
        );
    }
}