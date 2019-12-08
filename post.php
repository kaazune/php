<?php 

ini_set('display_errors',"On");

?>
<?php
    define("title", "step1");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
        <div class="center">
            <div class="step1">
                <img src="img/step1.png">
                <p></p>
            </div>
            
		    <form action="post2.php" method="post">
                <lavel for="title">投票のタイトル</lavel>
                <input type="text" name="title" placeholder="20文字まで" required>
                <lavel for="number">選択肢の数</lavel>
                <input type="text" name="num" placeholder="2~5" required>
                <lavel type="detail">投票の内容</lavel><textarea name="detail" placeholder="100文字まで"></textarea>
		        <input type="submit" name="submit_title" value="次へ" class="button" >
		    </form>
        </div>
		    

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>
