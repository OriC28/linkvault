<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Oriana',
            'email' => 'orianacolina.perea@gmail.com',
            'google_id' => '117679470097725080706',
        ]);

        User::factory(5)->create();
    }
}
