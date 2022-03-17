<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@r.ru',
            'password' => Hash::make('admin123'),
            'role'=>'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@r.ru',
            'password' => Hash::make('admin123'),
            'role'=>'user'
        ]);
    }
}
