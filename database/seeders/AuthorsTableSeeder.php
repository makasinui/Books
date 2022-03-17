<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            'name' => 'Михаил Афанасьевич Булгаков',
            'country' => 'Россия',
            'comment' => 'Русский писатель советского периода'
        ]);

        DB::table('authors')->insert([
            'name' => 'Герман Гессе',
            'country' => 'Германия',
            'comment' => 'Немецкий писатель и художник, лауреат Нобелевской премии.'
        ]);
    }
}
