<?php
    define("title", "Create Vote");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>

    <div class="center">
        <div class="wrapa">
            <p>誰でもかんたんに投票がつくれる！<br>投票をみんなに共有して回答をチェック！</p>
        </div>
        <div class="wrapb">
            <a href="post.php" class="button">投票作成 <i class="fas fa-pen"></i></a>
            <a href="#" class="button">投票を探す <i class="fas fa-search"></i></a>
            </div>
        <div class="share"></div>
    </div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>