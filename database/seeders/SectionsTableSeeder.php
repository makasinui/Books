<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'name' => 'Художественная литература',
            'description' => 'Художественная литература — это вид искусства, в котором материалом и средством для образного отображения действительности служат словесные конструкции',
        ]);
    }
}
