<?php

// PDOを使用するためインスタンス化
// ドキュメントから引用

// public PDO::__construct(
//     string $dsn,
//     ?string $username = null,
//     ?string $password = null,
//     ?array $options = null
// )

const DB_HOST = 'mysql:dbname=test_db;host=php-db;charset=utf8';
const DB_USER = 'php_user';
const DB_PASSWORD = 'password123';


// 例外処理 Exception
try {
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
        // エラー発生時に例外を投げる
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // デフォルトのフェッチモードを連想配列にする
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // エラー発生時に例外を投げる
        PDO::ATTR_EMULATE_PREPARES => false, // SQLインジェクション対策
    ]);
    echo '接続成功';
} catch (PDOException $e) {
    echo '接続失敗' . $e->getMessage() . "\n";
    exit();
}
