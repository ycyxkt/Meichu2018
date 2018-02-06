<?php

use Illuminate\Database\Seeder;

use App\News;
use Faker\Factory as Faker;


class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('zh_TW');;
        for ($i=0; $i < 10; $i++) {
            News::create([
                'title' => $faker->sentence(6, true),
                'content' => $faker->paragraph(),
                'group' => $faker->word(),
                'user_id' => 1,
                'tag' => $faker->randomElement(['ann_games', 'news', 'other']),
            ]);
        }
    }
}
