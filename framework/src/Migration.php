<?php

namespace Framework\Src;

include('Database.php');

class Migration
{
    public $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS forum.users
        (
            id SERIAL PRIMARY KEY,
            name varchar(255),
            lastname varchar(255),
            email varchar(255),
            password varchar(255)
        );
        
        CREATE TABLE IF NOT EXISTS forum.topics
        (
            id SERIAL PRIMARY KEY,
            topic_name varchar(200) NOT NULL,
            topic2user INT REFERENCES forum.users (id)
        );
        
        
        CREATE TABLE IF NOT EXISTS forum.articles
        (
            id SERIAL PRIMARY KEY,
            article_name varchar(255) NOT NULL,
            article_description text,
            article_files varchar(255),
            article2user INT REFERENCES forum.users (id),
            article2topic integer REFERENCES forum.topics (id)     
        );
        
        CREATE TABLE IF NOT EXISTS forum.comments
        (
            id SERIAL PRIMARY KEY,
            comment text NOT NULL,
            comment_files varchar(255),
            comment2user INT REFERENCES forum.users (id),
            comment2article INT REFERENCES forum.articles (id),
            last_update_date timestamp
        );";
        return $this->database->createTable($sql);
    }

    public function insertIntoTables()
    {
        $sql = "INSERT INTO forum.users(name, lastname, email, password)
            VALUES ('John', 'Johnson', 'jj@gmail.com', '123');
            COMMIT;

            INSERT INTO forum.topics(topic_name, topic2user)
	        VALUES 	('Автомобили', 1);
            COMMIT;
            
            INSERT INTO forum.articles(article_name, article_description, article_files, article2user, article2topic)
	        VALUES 
            ('Toyota', 'Toyota Motor Corporation (яп. トヨタ自動車株式会社 тоёта дзидо:ся кабусики-гайся) (кратко: Toyota — «Тоёта», по-русски чаще пишется «Тойота») — крупнейшая японская автомобилестроительная корпорация, также предоставляющая финансовые услуги и имеющая несколько дополнительных направлений в бизнесе. Является крупнейшей автомобилестроительной публичной компанией в мире, а также крупнейшей публичной компанией в Японии. Главный офис компании находится в городе Тоёта, префектура Айти, Япония. В списке крупнейших публичных компаний мира Forbes Global 2000 за 2022 год Toyota Motor заняла 10-е место, а в списке Fortune Global 500 — 13-е место.', 'toyota-crown.jpeg,Toyota-MARK-X.jpg,toyota-corolla.jpg,', 1, 1),
            ('Honda', 'Honda Motor Co., Ltd. (яп. 本田技研工業株式会社 хонда гикэн ко:гё кабусики гайся) — японская транснациональная корпорация, основанная в 1948 году изобретателем и предпринимателем Соитиро Хондой и финансистом Такэо Фудзисавой, производитель автомобилей и мотоциклов. Honda является крупнейшим производителем мотоциклов в мире с 1959 года, достигнув 400 миллионов произведённых мотоциклов к концу 2019, а также крупнейший в мире производитель двигателей внутреннего сгорания, производящий более 14 миллионов двигателей внутреннего сгорания ежегодно. В 2001 году Honda стала вторым по величине японским производителем автомобилей. В 2015 году Honda была восьмым по величине производителем автомобилей в мире.', 'Honda_Insight.jpg,honda-civic.jpeg,honda-accord.jpg,', 1, 1),
            ('Nissan', 'Nissan Motor Co., Ltd. (яп. 日産自動車株式会社 ниссан дзидо:ся кабусикигайся) — японский автопроизводитель, один из крупнейших в мире. Компания основана в 1933 году. Штаб-квартира находится в городе Иокогама. Входит в Альянс Renault–Nissan–Mitsubishi. В списке крупнейших публичных компаний мира Forbes Global 2000 за 2022 год Nissan Motor заняла 407-е место, а в списке Fortune Global 500 — 161-е место. По состоянию на 2017 год занимала 8-е место в мировом рейтинге автопроизводителей (2-е среди японских производителей, после Toyota) по версии международной организации производителей автомобилей.', 'nissan_altima.jpg,nissan-sentra.jpg,nissan-maxima.jpg,', 1, 1);
            COMMIT;

            INSERT INTO forum.comments(comment, comment2user, comment_files, comment2article, last_update_date)
	        VALUES 
            ('Тойота лучший автопроизводитель мира! Владельцы остальных автомобилей:', 1, 'palka-768x359.jpg,', 1, '2022-11-12 11:30'),
            ('Хонда делает самые быстрые гражданские (и не только) авто!', 1, null, 2, '2022-11-12 17:28'),
            ('Nissan с технологией E-power ушли очень далеко от остальных автокомпаний!)', 1, null , 3, '2022-11-12 21:16');
            COMMIT;
            ";
        return $this->database->insertIntoTables($sql);
    }
}

$migration = new Migration;
$migration->createTable();
$migration->insertIntoTables();