<?

// =================== Basic認証 ====================
// パスワードを暗号化する
// echo __FILE__;
// /var/www/html/mainte/test.php

// パスワード(暗号化)
// echo '<br>';
// echo password_hash('password123', PASSWORD_BCRYPT);
// $2y$10$j6gX1R/mt4Fldy/ldhwKDu1vyjm/4NSFlxpCI3.qNhGAp/GU1R6Bu


// =================== ファイル操作 ====================

$contactFile = '.contact.dat';

// ファイル丸ごと読み込み
$fileContents = file_get_contents($contactFile);

echo $fileContents;

// ファイルに書き込み(上書き)
file_put_contents($contactFile, 'テストです');

$addText = 'テストです' . "\n";

// ファイルに書き込み(追記)
file_put_contents($contactFile, $addText, FILE_APPEND);

// 配列 file, explode, implode
$allData = file($contactFile);

foreach($allData as $lineData){
    $lines = explode(',', $lineData);
    echo $lines[0] . '<br>';
    echo $lines[1] . '<br>';
    echo $lines[2] . '<br>';
}