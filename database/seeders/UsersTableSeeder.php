<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
//        $users = [
//            [
//                'id'                 => 1,
//                'name'               => 'Admin',
//                'email'              => 'admin@admin.com',
//                'password'           => bcrypt('password'),
//                'remember_token'     => null,
//                'verified'           => 1,
//                'verified_at'        => '2022-08-05 14:43:21',
//                'verification_token' => '',
//                'lastname'           => '',
//                'phone'              => '1'.random_int(9,9),
//                'address'            => '',
//                'address_2'          => '',
//            ],
//        ];
//
//        User::insert($users);
        User::factory(30)->create();
    }
}
