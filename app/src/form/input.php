<?php

session_start();

header('X-FRAME-OPTIONS: DENY');

// スーパーグローバル変数 php 9種類 連想配列
if (!empty($_SESSION)) {
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
}

// ================= XSS対策 =================
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// ================= CSRF対策 =================
// CSRF 偽物のinput.phpを作成してしまう
// 対策: 偽物か本物を見分けるため合言葉を使用 -> sessionトークンを使用する



$pageFlag = 0;

// btn_confirmが押されたらpageFlagを1にする
if (!empty($_POST['btn_confirm'])) {
    $pageFlag = 1;
}

// btn_submitが押されたらpageFlagを2にする
if (!empty($_POST['btn_submit'])) {
    $pageFlag = 2;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn-php</title>
</head>

<body>


    <!-- ページフラッグ -->
    <?php if ($pageFlag === 1) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            <form method="POST" action="input.php">
                氏名
                <?php echo h($_POST['your_name']); ?>
                <br>
                メールアドレス
                <?php echo h($_POST['email']); ?>
                <br>
                <input type="submit" name="back" value="戻る">
                <input type="submit" name="btn_submit" value="送信する">
                <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']); ?>">
                <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
                <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($pageFlag === 2) : ?>
        <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
            送信が完了しました。
            <?php unset($_SESSION['csrfToken']); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($pageFlag === 0) : ?>
        <!-- session  -->
        <?php
        if (!isset($_SESSION['csrfToken'])) {
            // 16進数に変換する(トークン)
            $csrfToken = bin2hex(random_bytes(32));
            $_SESSION['csrfToken'] = $csrfToken;
        }
        $token = $_SESSION['csrfToken'];

        ?>
        <form method="POST" action="input.php">
            氏名
            <input type="text" name="your_name" value="<?php if (!empty($_POST['your_name'])) {
                                                            echo h($_POST['your_name']);
                                                        } ?>">
            <br>
            メールアドレス
            <input type="email" name="email" value="<?php if (!empty($_POST['email'])) {
                                                        echo h($_POST['email']);
                                                    } ?>">
            <br>
            <input type="submit" name="btn_confirm" value="確認する">
            <input type="hidden" name="csrf" value="<?php echo $token; ?>">
        </form>
    <?php endif; ?>
</body>

</html>