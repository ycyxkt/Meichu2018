<?php

use Illuminate\Database\Seeder;

class TextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Text::truncate();
        \App\Text::create([
            'name' => 'ticket_nthu',
        ]);
        \App\Text::create([
            'name' => 'ticket_nctu',
        ]);
    }
}
