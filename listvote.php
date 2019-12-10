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

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>投票システム</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>


<form action="listvote.php" method="post">
<input type="text" name="title_sch" required>
<input type="submit" name="submit_sch" value="検索" >
</form>

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
        
     投票一覧   
                <ul>        
                <?php for($i=0;$i<$c1;$i++){ ?>
                    <li>
                    <?php echo htmlspecialchars($stmt_list[$i]['title']). " : " . htmlspecialchars($stmt_list[$i]['detail']); ?>
                    <input type='hidden' name='title_id' value=' <?php echo $i; ?> ' >
                     <input type="submit" name="submit_list<?php echo $i; ?>" value="この投票をみる<?php echo $i; ?>">
                     </li>
                    <?php
                }
                ?>
                </ul>
   </form>
    

</body>
</html>