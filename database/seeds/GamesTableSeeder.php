<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Game::truncate();
        \App\Game::create([
            'game' => 'opening',
            'name' => '開幕',
            'type' => 'notgame',
            'date' => '2018/03/02',
            'time' => '13:00',
            'location' => '清大田徑場',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'closing',
            'name' => '閉幕',
            'type' => 'notgame',
            'date' => '2018/03/04',
            'time' => '22:30',
            'location' => '清大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'football-general',
            'name' => '足球表演賽（一般組）',
            'type' => 'exhibition',
            'date' => '2018/03/02',
            'time' => '14:30',
            'location' => '清大田徑場',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'football-open',
            'name' => '足球友誼賽（公開組）',
            'type' => 'friendly',
            'date' => '2018/03/04',
            'time' => '14:30',
            'location' => '交大田徑場',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'kendo',
            'name' => '劍道表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/02',
            'time' => '16:30',
            'location' => '交大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);
        \App\Game::create([
            'game' => 'billiards',
            'name' => '撞球表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/02',
            'time' => '16:30',
            'location' => '交大活動中心B1',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);
        \App\Game::create([
            'game' => 'women-tabletennis',
            'name' => '女子桌球表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/02',
            'time' => '15:30',
            'location' => '清大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'tabletennis',
            'name' => '桌球正式賽',
            'type' => 'official',
            'date' => '2018/03/02',
            'time' => '18:30',
            'location' => '清大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'badminton',
            'name' => '羽球正式賽',
            'type' => 'official',
            'date' => '2018/03/02',
            'time' => '19:30',
            'location' => '清大校友體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => true,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'men-badminton',
            'name' => '男子羽球體資體保友誼賽',
            'type' => 'friendly',
            'date' => '2018/03/02',
            'time' => '22:30',
            'location' => '清大校友體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => true,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'bridge',
            'name' => '橋藝正式賽',
            'type' => 'official',
            'date' => '2018/03/03',
            'time' => '09:00',
            'location' => '清大蒙民偉樓101',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);
        \App\Game::create([
            'game' => 'chess',
            'name' => '棋藝正式賽（象棋）',
            'type' => 'official',
            'date' => '2018/03/03',
            'time' => '09:30',
            'location' => '交大活動中心2F聯誼廳',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);
        \App\Game::create([
            'game' => 'go',
            'name' => '圍棋表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/03',
            'time' => '09:30',
            'location' => '交大活動中心4F聯誼廳',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);

        \App\Game::create([
            'game' => 'baseball',
            'name' => '棒球正式賽',
            'type' => 'official',
            'date' => '2018/03/03',
            'time' => '13:00',
            'location' => '清大棒球場',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'tennis',
            'name' => '網球正式賽',
            'type' => 'official',
            'date' => '2018/03/03',
            'time' => '13:00',
            'location' => '交大綜合球館2F',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);
        \App\Game::create([
            'game' => 'women-tennis',
            'name' => '女網表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/03',
            'time' => '10:00',
            'location' => '交大綜合球館2F',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);
        \App\Game::create([
            'game' => 'women-basketball',
            'name' => '女籃正式賽',
            'type' => 'official',
            'date' => '2018/03/03',
            'time' => '18:00',
            'location' => '交大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => true,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'men-basketball',
            'name' => '男籃正式賽',
            'type' => 'official',
            'date' => '2018/03/03',
            'time' => '20:30',
            'location' => '交大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => true,
            'is_broadcast' => true,
        ]);

        \App\Game::create([
            'game' => 'softball-general',
            'name' => '壘球表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/04',
            'time' => '10:00',
            'location' => '清大棒球場',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'softball-open',
            'name' => '壘球表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/04',
            'time' => '13:00',
            'location' => '清大棒球場',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'darts',
            'name' => '飛鏢表演賽',
            'type' => 'exhibition',
            'date' => '2018/03/04',
            'time' => '10:30',
            'location' => '清大風雲樓3F',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => false,
            'is_broadcast' => false,
        ]);
        \App\Game::create([
            'game' => 'men-volleyball',
            'name' => '男排正式賽',
            'type' => 'official',
            'date' => '2018/03/04',
            'time' => '18:00',
            'location' => '清大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => true,
            'is_broadcast' => true,
        ]);
        \App\Game::create([
            'game' => 'women-volleyball',
            'name' => '女排正式賽',
            'type' => 'official',
            'date' => '2018/03/04',
            'time' => '20:20',
            'location' => '清大體育館',
            'location_url' => '123',
            'status' => 'notyet',
            'is_ticket' => true,
            'is_broadcast' => true,
        ]);
    }
}
