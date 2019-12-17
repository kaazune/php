<?php
    define("title", "Create Vote");
    include('config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');

    if(isset($_POST['out'])){
        if(isset($_SESSION["NAME"])){
            $errorMessage = "ログアウトが完了しました";
            $_SESSION = array();
            @session_destroy();
?>         
            <div class="outmes">
                <p><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></p>
            </div>
<?php
        } else {
            $errorMessage = "セッションがタイムアウトしました";
            $_SESSION = array();
            @session_destroy();
?>         
            <div class="outmes">
                <p><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></p>
            </div>
<?php
        }
    }





    $c1=0;
    $sql_list="select * from title";
    $stmt_list = array();
    foreach ($mysqli->query($sql_list) as $a1) {
        array_push($stmt_list,$a1);
        $c1++;
    }
    $min=0;
    $max=$c1-1;
    $rand = range($min,$max);
    shuffle($rand);
    $rand = array_slice($rand,0,10);
    
    
    
?>

    <div class="wrapper">
        <div class="wrapa">
            <p>誰でもかんたんに投票がつくれる！<br>投票をみんなに共有して回答をチェック！</p>
        </div>
        <div class="wrapb">
            <a href="post.php" class="button3">投票作成<!--<i class="fas fa-pen"></i>--></a>
            <a href="listvote.php" class="button3">投票を探す<!--<i class="fas fa-search"></i>--></a>
            </div>
        <div class="share"></div>
    </div>
    
    
    <div class="form2">
    <form action="viewvote.php" method="post" name="formform"> 
        <input type='hidden' name='c1' value=' <?php echo $c1; ?> ' >
        <input type='hidden' name='c2' value=' <?php echo $c2; ?> ' >
        
    <!--　おすすめの投票を表示　-->
    <div class="heading">
            <p>おすすめの投票</p>
        </div>
        <div class="container2">
            <?php
            $a=0;
            while($a!=10){ ?>
            
                <div class="grid2">
                    <?php
                        $rand_array=$rand[$a];
                    ?>
                    <button type="submit" name="submit_recd<?php echo $a; ?>" value="この投票をみる" class="grid-in2">
                        <span class="bold2"><?php echo htmlspecialchars($stmt_list[$rand_array]['title']); ?></span>
                        <span class="small2"><?php echo htmlspecialchars($stmt_list[$rand_array]['detail']); ?></span>
                        <input type='hidden' name='title_id<?php echo $a; ?>' value='<?php echo $rand[$a]; ?>'>
                    </button>
                </div>
            <?php $a++;
            } ?>
        </div>
    </form>

</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>