<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =[
            [
                'name'      => 'Selim',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'selim@gmail.com',
                'password'  => Hash::make(12345678),
                'isAdmin'   => true,
            ],
            [
                'name'      => 'Yasemin',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'yasemin@gmail.com',
                'password'  => Hash::make(12345678),
                'isAdmin'   => false,
            ],
            [
                'name'      => 'Serdar',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'serdar@gmail.com',
                'password'  => Hash::make(12345678),
                'isAdmin'   => false,
            ],
            [
                'name'      => 'Selcuk',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'selcuk@gmail.com',
                'password'  => Hash::make(12345678),
                'isAdmin'   => false,
            ],
        ];
        DB::table('users')->insert($user);

        /*User::create(
            [
                'name'      => 'Selim',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'selim@gmail.com',
                'password'  => Hash::make(12345678),
            ],
            [
                'name'      => 'Serdar',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'serdar@gmail.com',
                'password'  => Hash::make(12345678),
            ],
            [
                'name'      => 'Selçuk',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'selcuk@gmail.com',
                'password'  => Hash::make(12345678),
            ],
            [
                'name'      => 'Yasemin',
                'lastname'  => 'Pınarbaşı',
                'email'     => 'yasemin@gmail.com',
                'password'  => Hash::make(12345678),
            ]

        DB::table('users')->insert();
        );*/
    }
}
