<?php

use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            [
                'model' => 'Zoe',
                'outlet' => 'a'
            ],
            [
                'model' => 'Etron',
                'outlet' => 'b'
            ],
            [
                'model' => 'Leaf',
                'outlet' => 'c'
            ]
        ]);
    }
}
