<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'          => 'Genel',
                'description'   => 'Genel ile ilgili haberler',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Teknoloji',
                'description'   => 'Teknoloji ile ilgili haberler',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Sağlık',
                'description'   => 'Sağlık ile ilgili haberler',
                'created_at'    => now(),
            ],
            [
                'name'          => 'Ekonomi',
                'description'   => 'Ekonomi ile ilgili haberler',
                'created_at'    => now(),
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
