<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('products')->insert([
            'title' => 'WeDevs Product Sample',
            'description' => 'It is a long established fact that a reader
               will be distracted by the readable content of a page when
               looking at its layout. The point of using Lorem Ipsum is
               that it has a more-or-less normal distribution of letters,
               as opposed to using 
                making it look like readable English. Many desktop publishing
                packages and web page editors now use Lorem Ipsum as their
                default model text, and a search for will uncover many web 
                sites still in their infancy. Various versions have evolved over
                the years.',
            'price' => '540',
            'image' => '',
        ]);
    }
}
