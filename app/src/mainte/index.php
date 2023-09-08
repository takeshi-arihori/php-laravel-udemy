<?php
require 'db_connection.php';

// ユーザー入力なし query
$sql = 'select * from contacts where id = 1';
$stmt = $pdo->query($sql); //sql実行されている状態 $stmt->ステートメント

$result = $stmt->fetchall();
var_dump($result);

// ユーザー入力あり prepare, bind, execute
// $sql = 'select * from contacts where id = :id';


