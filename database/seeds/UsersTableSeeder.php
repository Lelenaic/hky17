<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'test@test.com',
            'password' => bcrypt('test'),
            'name' => 'Test user',
            'car_id' => 1
        ]);
    }
}
