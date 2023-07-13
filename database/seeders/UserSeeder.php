<?php

namespace Database\Seeders;

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
        //

        DB::table('users')->insert([[
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123') ,
            'phone' => '0123456789012',
            'address' => 'admin address, on admin street',
            'role' => 2,
        ],[
            'name' => 'member',
            'email' => 'member@gmail.com',
            'password' => Hash::make('member123') ,
            'phone' => '123213123321312',
            'address' => 'member address, on member street',
            'role' => 1,
        ]]);
    }
}
