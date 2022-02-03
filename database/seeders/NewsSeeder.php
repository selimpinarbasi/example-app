<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = [
            [
                'category_id'   => 1,
                'user_id'       => 1,
                'title'         => 'This is a title',
                'content'       => 'example content xxxxx',
                'created_at'          => now(),
                'image'         => 'example.png',
            ],
            [
                'category_id'   => 2,
                'user_id'       => 1,
                'title'         => 'yyyyyyy',
                'content'       => 'example content zzz',
                'created_at'          => now(),
                'image'         => 'example-2.png',
            ],
            [
                'category_id'   => 3,
                'user_id'       => 1,
                'title'         => '333333',
                'content'       => 'example content 33333333',
                'created_at'          => now(),
                'image'         => 'example-3.png',
            ],
            [
                'category_id'   => 4,
                'user_id'       => 1,
                'title'         => '4',
                'content'       => 'example content 4',
                'created_at'          => now(),
                'image'         => 'example-4.png',
            ],
        ];

        DB::table('news')->insert($news);
    }
}
