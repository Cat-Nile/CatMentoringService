<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'name' => '고냥이',
            'breed' => 'korean_short_hair',
            'age' => 10,
            'hair' => 'black',
            'role' => 'mentor',
        ]);
        \App\Models\User::factory()->times(9)->create();
    }
}
