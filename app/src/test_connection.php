<?php
try {
    $pdo = new PDO('mysql:dbname=test_db;host=php-db;charset=utf8', 'test', 'test');
    echo '接続成功';
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
}
?>
