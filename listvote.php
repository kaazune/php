<?php
// エラーを出力する
ini_set('display_errors', "On");
ob_start();

include('config.php');

//すべてのタイトルを表示
$c1=0;
$sql_list="select * from title";
$stmt_list = array();
foreach ($mysqli->query($sql_list) as $a1) {
        array_push($stmt_list,$a1);
        $c1++;
}

$c2=0;
//検索する
if (!empty($_POST['submit_sch'])) {
    if( (!isset($_POST['title_sch'])) || ( $_POST['title_sch']==="")) {
        echo "検索ワードを入力してください";
    }else {
        $search = htmlspecialchars($_POST['title_sch']);
        $sql_sch = "select * from title where title like '%$search%'";
        foreach ($mysqli->query($sql_sch) as $a2) {
            array_push($stmt_list,$a2);
            $c2++;
         }
    } 
}

$c=$c1+$c2;

//おすすめの投票をランダムで決める
$min=0;
$max=$c1-1;
$rand = range($min,$max);
shuffle($rand);
$rand = array_slice($rand,0, 10);

?>

<?php
    define("title", "Find vote");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>


<div class="form1">
    <h2>投票をさがす</h2>
    <form action="listvote.php" method="post">
        <input type="text" name="title_sch" required autocomplete="off">
        <input type="submit" name="submit_sch" value="検索">
        <!--
        <button type="submit" name="submit_sch">
            <i class="fas fa-search"></i>
        </button>
        -->
    </form>
</div>

<div class="form2">
    <h2>
        投票一覧
    </h2>
    <form action="viewvote.php" method="post" name="formform"> 
        <input type='hidden' name='c1' value=' <?php echo $c1; ?> ' >
        <input type='hidden' name='c2' value=' <?php echo $c2; ?> ' >

<?php if (!empty($_POST['submit_sch'])) { ?>
        <?php if ($c2==0) { ?>
            <strong>該当する結果はありません</strong> <br >
        <?php } else {  ?>
            検索結果
                <ul>        
                <input type='hidden' name='title_sch' value=' <?php echo $search; ?> ' >
                <?php for($r=$c1;$r<$c;$r++){ ?>
                    <li>
                    <?php echo htmlspecialchars($stmt_list[$r]['title']). " : " . htmlspecialchars($stmt_list[$r]['detail']); ?>
                    <input type='hidden' name='title_id' value=' <?php echo $r; ?> ' >
                     <input type="submit" name="submit_list<?php echo $r; ?>" value="この投票をみる<?php echo $r; ?>">
                     </li>
                    <?php
                } ?>
                </ul>
    <?php }   
        } ?>
        
        
    おすすめの投票   
        <ul>        
            <?php 
            $a=0;
            while($a!=10){ ?>
                <li>
                    <?php 
                        $rand_array=$rand[$a];
                        echo htmlspecialchars($stmt_list[$rand_array]['title']). " : " . htmlspecialchars($stmt_list[$rand_array]['detail']); 
                    ?>
                    <input type='hidden' name='title_id<?php echo $a; ?>' value=' <?php echo $rand[$a]; ?>' >
                    <input type="submit" name='submit_recd<?php echo $a; ?>' value="この投票をみる">
                </li>
            <?php $a++;
            } ?>
        </ul>

   
                <div class="container">     
                <?php for($i=0; $i<$c1; $i++){ ?>
                    
                
                    <input type='hidden' name='title_id' value=' <?php echo $i; ?> ' >
                    <div class="grid">
                        <button type="submit" name="submit_list<?php echo $i; ?>" value="投票を見る" class="grid1">
                            <span class="bold2"><?php echo htmlspecialchars($stmt_list[$i]['title']); ?></span>
                            <span class="small2"><?php echo htmlspecialchars($stmt_list[$i]['detail']); ?></span>
                        </button>
                    </div>
                    
                    
                <?php
                }
                ?>
                </div>
</form>
    

</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>