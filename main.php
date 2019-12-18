<?php
ob_start();
include("config.php");
define("title", "My page | Create Vote");
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');


#login check!
if(!isset($_SESSION["NAME"])){ #新規のセッションIDがなかったらログイン画面に移る
    header("Location:login.php");
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

<div class="mypage">
    <h1>My page</h1>
    <form action="index.php" method="post" class="out-form">
        <button type="submit" value="logout" name="out" class="outbutton">ログアウト</button>
    </form>
        
    <?php
    /*
    <p>Hello!!<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>
    */
    ?>
        
    <form action="viewvote.php" method="post" class="my-form"> 
        <div class="heading">
            <p><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?>さんの投票一覧</p>
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


<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>