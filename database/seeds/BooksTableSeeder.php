<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert(
            [
                'name' => 'Harry Potter y la Piedra Filosofal',
                'image' => '1-piedra-filosofal.jpeg',
                'stock' => '0',
                'price' => '2000',
            ]
        );
        DB::table('books')->insert(
            [
                'name' => 'Harry Potter y la Camara Secreta',
                'image' => '2-camara-secreta.jpeg',
                'stock' => '2',
                'price' => '2000',
            ]
        );
        DB::table('books')->insert(
            [
                'name' => 'Harry Potter y el Prisionero de Azkaban',
                'image' => '3-prisionero-azkaban.jpeg',
                'stock' => '20',
                'price' => '2000',
            ]
        );
        DB::table('books')->insert(
            [
                'name' => 'Harry Potter y el Caliz de Fuego',
                'image' => '4-caliz-fuego.jpeg',
                'stock' => '20',
                'price' => '2000',
            ]
        );
        DB::table('books')->insert(
            [
                'name' => 'Harry Potter y la Orden del Fenix',
                'image' => '5-orden-fenix.jpeg',
                'stock' => '20',
                'price' => '2000',
            ]
        );
        DB::table('books')->insert(
            [
                'name' => 'Harry Potter y el Misterio del Principe',
                'image' => '6-misterio-principe.jpeg',
                'stock' => '20',
                'price' => '2000',
            ]
        );
    }
}
