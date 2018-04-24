# Meichu2018

戊戌梅竹官方網站 | The offical website of 2018 Meichu Game [https://meichu.games](https://meichu.games)

![Screenshot of website](https://meichu.games/images/screenshot.png)

## 網站Sitemap
```

https://meichu.games/
    |
    |- 首頁             /
    |- 賽事戰況         /games
        |- 各賽事資訊   /games/(name)
    |- 票務             /tickets
    |- 最新消息         /news
        |- 各消息內文   /news/(number)
    |- 關於梅竹         /about
    |- 主題曲           /song
    |- 相關活動         /events
    |- 遺失物           /losts
    |- 後台頁面         /m

```

## 網站佈屬環境

- Ubuntu 16.04
- Nginx 1.10.3(Ubuntu)
- MYSQL Ver 14.14
- PHP 7.0.28
- Laravel 5.5.29
- Redis-server
    
    `sudo apt-get install redis-server`

## 安裝步驟

1. git clone

    `git clone https://github.com/ycyxkt/Meichu2018.git .`

2. 安裝相關package

    `composer install`

3. 還原`.env`檔

    若在目錄中未出先`.env`，則請先做以下步驟
    ```Shell
    cp .env.example .env
    php artisan key:generate
    ```

    將資料庫設定填入`.env`中
    ```
    DB_HOST=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```

4. 重建資料庫Schema

    `php artisan migrate`

5. 重建資料庫資料

    `php artisan db:seed`

6. 在`.env`中，設定Imgur (因後台上傳照片皆使用Imgur)

    ```
    IMGUR_CLIENT_ID=
    IMGUR_CLIENT_SECRET=
    ```

*備註：後台(`/m`)登入，預設帳密請見`/database/seeds/UsersTableSeeder.php`

## 網站成效報告

使用Google Analytics進行統計與分析，統計期間為2018/02/07-2018/03/06（賽後兩天）

相關數據報告請見[這裡](https://github.com/ycyxkt/Meichu2018/blob/master/StaisticsOfWebsite2018.pdf)


> 戊戌梅竹賽籌備委員會保有網站相關權利

> 特別感謝 [@banqhsia](https://github.com/banqhsia) 在製作時提供許多意見與提點。