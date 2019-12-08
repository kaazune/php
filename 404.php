<?php
    define("title", "404error");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>

<div class="center">
    <h1>404 Not Found</h1>
    <h2>お探しのページは見つかりませんでした！</h2>
    <p>あなたがアクセスしようとしたページは削除されたかURLが変更されているため，見つけることができません．<br><a href="index.php">「Create Vote」トップページへ</a></p>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>