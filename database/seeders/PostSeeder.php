<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::create([
            'user_id' => 1,
            'subject' => '집사에 대한 질문입니다.',
            'content' => '제가 먼치킨 고양이인데 집사가 다리짧다고 놀리는데 냥냥펀치 날려야 할까요?',
            'category' => '집사후기',
        ]);
        \App\Models\Post::factory()->times(24)->create();
    }
}
