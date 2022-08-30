<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Comment::create([
            'user_id' => 1,
            'post_id' => 1,
            'content' => '츄르 주면 용서하는데 안 줬다면 날려도 무죄입니다.',
        ]);
        \App\Models\Comment::factory()->times(499)->create();
    }
}
