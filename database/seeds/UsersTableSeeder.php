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
            'name' => 'Yun-Chin Yang',
            'email' => 'ycyxkt',
            'password' => bcrypt('ycyycy'),
            'school' => 'NCTU',
            'group' => 'admin',
        ]);
    }
}
