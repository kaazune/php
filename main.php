<?php

session_start();

#login check!
if(!isset($_SESSION["NAME"])){ #新規のセッションIDがなかったらログアウト画面に移る
    header("Location: Logout.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>メイン画面</title>
    </head>
    <body>
        <h1>メイン画面</h1>
        <p>Hello!!<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>
        <ul>
            <li><a href = "Logout.php">ログアウトはこちらから</a></li>
        </ul>
    </body>
</html>