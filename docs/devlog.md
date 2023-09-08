# 学習 log

## スーパーグローバル変数 php 9 種類 連想配列

```
if(!empty($_POST)){
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
}
```

- フォームの送信方法
  - GET
  - POST
  - PUT
  - DELETE
  - PATCH
  - OPTIONS
  - HEAD
  - TRACE
  - CONNECT

## form を使用して page を遷移

## フォームセキュリティ

#### XSS 対策
クロスサイトスクリプティングとは、攻撃者が送り込んだ悪意のコードをそのページを閲覧した不特定多数のユーザーに、スクリプト(簡易的なプログラム)として実行させる可能性があることを指します

php -> htmlspecialchars

[htmlspecialchars ドキュメント](https://www.php.net/manual/ja/function.htmlspecialchars)

- 使い方
  上の方に記述する

```
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
```

各 form で呼び出しているか箇所を変更する

#### クリックジャッキング攻撃を防ぐために

- 使い方
  header('X-FRAME-OPTIONS: DENY');

#### CSRF 対策

クロスサイトリクエストフォージェリ（CSRF）とは、Web アプリケーションに存在する脆弱性、もしくはその脆弱性を利用した攻撃方法のことです。掲示板や問い合わせフォームなどを処理する Web アプリケーションが、本来拒否すべき他サイトからのリクエストを受信し処理してしまいます。

## Basic認証

#### test.php
```
<?

// パスワードを暗号化する
echo __FILE__;
// /var/www/html/mainte/test.php

// パスワード(暗号化)
echo '<br>';
echo password_hash('password123', PASSWORD_BCRYPT);
// $2y$10$j6gX1R/mt4Fldy/ldhwKDu1vyjm/4NSFlxpCI3.qNhGAp/GU1R6Bu


```

#### .htaccess
```
AuthType Basic
AuthName "IDとパスワードを入力して下さい"
AuthUserFile /var/www/html/mainte/.htpasswd
require valid-user
```

#### .htpasswd
```
admin:$2y$10$j6gX1R/mt4Fldy/ldhwKDu1vyjm/4NSFlxpCI3.qNhGAp/GU1R6Bu
```

## ファイルのアップロード

#### アップロード

[ファイルアップロード](https://qiita.com/tadsan/items/0955b3de7dc58490ddaf)

.contact.dat
```
タイトル1,本文,日付,カテゴリ
タイトル2,本文,日付,カテゴリ
タイトル3,本文,日付,カテゴリ
CSSV形式、ファイル

```

#### ファイル操作

```
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
```