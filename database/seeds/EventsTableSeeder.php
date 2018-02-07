<?php

use Illuminate\Database\Seeder;

use App\Event;
use Faker\Factory as Faker;


class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('zh_TW');;
        for ($i=0; $i < 5; $i++) {
            Event::create([
                'title' => $faker->sentence(6, true),
                'location' => $faker->word(),
                'group' => $faker->randomElement(["梅竹賽籌備委員會", "清大梅竹工作會", "交大梅竹後援會"]),
                'user_id' => 1,
                'date' => $faker->randomElement(["2018-02-08", "2018-02-09", "2018-02-10"]),
                'time' => $faker->randomElement(["12:00", "16:00", "20:00"]),
                'tag' => $faker->randomElement(["交大索票活動", "清大索票活動", "賽事相關活動", "交大賽前活動", "清大賽前活動", "兩校賽前活動"]),
            ]);
        }
    }
}