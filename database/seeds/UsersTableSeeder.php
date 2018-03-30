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
        //
        \App\User::truncate();
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin',
            'password' => bcrypt('meichu2018'),
            'school' => 'other',
            'group' => 'admin',
        ]);
    }
}
