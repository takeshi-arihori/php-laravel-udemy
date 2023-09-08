<?php

// 接続
$dsn = 'mysql:dbname=test_db;host=run-php-db;';
$user = 'test';
$password = 'test';


try{
    $pdo = new PDO($dsn, $user, $password);
    $sth = $pdo->query("SELECT first_name AS 名前, age AS 年齢 FROM users WHERE id = 1");
    $user = $sth->fetch(PDO::FETCH_ASSOC);
    var_dump($user);
} catch (PDOException $e) {
    print('Error:'.$e->getMessage());
    exit;
}

