<?php 

ini_set('display_errors',"On");

?>
<?php
    define("title", "step1 | Create Vote");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
        <div class="center">
            <div class="step1">
                <img src="img/step1.png">
                <p></p>
            </div>
            
		    <form action="post2.php" method="post" class="post">
                <lavel for="title">投票のタイトル</lavel>
                <input type="text" name="title" placeholder="15文字まで" required autocomplete="off" maxlength="15">
                <lavel for="number">選択肢の数</lavel>
                <input type="tel" name="num" required autocomplete="off" >
                <lavel type="detail">投票の内容</lavel><textarea name="detail" placeholder="50文字まで" maxlength="50" ></textarea>
                <!--
                <lavel for="checkbox">パスワードをかける</lavel>
                <input type="checkbox" id="checkbox" name="checkbox">
                
                <lavel for="pw" id="pwlabel">パスワード</lavel>
                <input type="text" id="pw" name="pw" value="" autocomplete="off">
                -->
		        <input type="submit" name="submit_title" value="次へ" class="button" >
		    </form>
        </div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>
