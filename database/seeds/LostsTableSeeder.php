`<?php

use Illuminate\Database\Seeder;

use App\Lost;
use Faker\Factory as Faker;

class LostsTableSeeder extends Seeder
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
            Lost::create([
                'title' => $faker->sentence(6, true),
                'content' => $faker->sentence(),
                'group' => $faker->word(),
                'user_id' => 1,
                'location' => $faker->randomElement(['交大', '清大']),
                'date' => $faker->randomElement(['2018-03-02', '2018-03-03', '2018-03-04']),
                'tag' => $faker->randomElement(['兩校賽前活動', '女籃正式賽']),
            ]);
        }
    }
}
