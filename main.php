<?php
include("config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');


#login check!
if(!isset($_SESSION["NAME"])){ #新規のセッションIDがなかったらログアウト画面に移る
    header("Location: Logout.php");
    exit;
}

$c_id=0;
$user_id=intval($_SESSION['ID']);
$sql_userid = "select * from title where user_id=$user_id";
$stmt_userid=array();
    foreach ($mysqli->query($sql_userid) as $a2) {
        array_push($stmt_userid,$a2);
        $c_id++;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MY PAGE</title>
    </head>
    <body>
        <h1>MY PAGE</h1>
        <p>Hello!!<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>
        
    <form action="viewvote.php" method="post" name="formform"> 
        <div class="heading">
                    <p> <?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?> さん作成した投票</p>
                </div>
                <div class="container">
                
                <?php 
                for($i=0;$i<$c_id;$i++){ 
                    $user_id=$stmt_userid[$i]['id'];
                    ?>
                    <input type='hidden' name='c_id' value=' <?php echo $user_id; ?> ' >
                    <div class="grid">
                        <button type="submit" name="submit_user<?php echo $i; ?>" value="投票を見る" class="grid-in">
                            <span class="bold2"><?php echo htmlspecialchars($stmt_userid[$i]['title']); ?></span>
                            <span class="small2"><?php echo htmlspecialchars($stmt_userid[$i]['detail']); ?></span>
                        </button>
                   </div>
                    
                <?php
                }
                ?>
                </div>
    </form>
        
        <ul>
            <li><a href = "Logout.php">ログアウトはこちらから</a></li>
        </ul>
    </body>
</html>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>