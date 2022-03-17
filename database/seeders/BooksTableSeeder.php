<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'name' => 'Мастер и Маргарита',
            'author_id' => '1',
            'section_id'=>'1',
            'description' => 'Роман Михаила Афанасьевича Булгакова, работа над которым началась в декабре 1928 года и продолжалась вплоть до смерти писателя',
            'img' => 'http://m-bulgakov.ru/wp-content/uploads/o68.jpg',
        ]);

        DB::table('books')->insert([
            'name' => 'Морфий',
            'author_id' => '1',
            'section_id'=>'1',
            'description' => 'Рассказ русского писателя Михаила Булгакова, опубликованный в 1926 году',
            'img' => 'https://cdn.eksmo.ru/v2/ASE000000000721448/COVER/cover1.jpg',
        ]);

        DB::table('books')->insert([
            'name' => 'Собачье сердце',
            'author_id' => '1',
            'section_id'=>'1',
            'description' => 'Повесть Михаила Булгакова 1925 года.',
            'img' => 'https://images.wbstatic.net/big/new/16070000/16072162-1.jpg',
        ]);

        DB::table('books')->insert([
            'name' => 'Степной волк',
            'author_id' => '2',
            'section_id'=>'1',
            'description' => 'Роман Германа Гессе, впервые опубликованный в 1927 году в Германии.',
            'img' => 'https://knigamir.com/upload/iblock/b73/b73fe45c4399668b85aed3bdabd50c92.jpg',
        ]);

        DB::table('books')->insert([
            'name' => 'Игра в бисер',
            'author_id' => '2',
            'section_id'=>'1',
            'description' => 'Последний и главный роман немецко-швейцарского писателя Германа Гессе, над которым он работал с 1931 по 1942 год. Впервые роман опубликован 18 ноября 1943 года в цюрихском издательстве «Фретц и Васмут» в двух томах. В 1946 году Гессе был награждён Нобелевской премией по литературе.',
            'img' => 'https://cdn.eksmo.ru/v2/ASE000000000840825/COVER/cover1.jpg',
        ]);

        DB::table('books')->insert([
            'name' => 'Демиан',
            'author_id' => '2',
            'section_id'=>'1',
            'description' => 'Роман немецкого писателя Германа Гессе, впервые опубликованный в 1919 году. В 1960 году к роману был также добавлен пролог. «Демиан» был опубликован Гессе под псевдонимом «Эмиль Синклер»: это имя он впервые использовал в 1917 году при написании политического эссе; также Эмиль Синклер - это имя рассказчика в романе.',
            'img' => 'https://cdn.eksmo.ru/v2/ASE000000000837187/COVER/cover1.jpg',
        ]);

        

    }
}
