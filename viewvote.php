<?php
// エラーを出力する
/*
ini_set('display_errors', "On");
*/
ob_start();
include('config.php');

//ここから
if($_POST['c1']){
	//listvote.phpから
	$c1=intval($_POST['c1']);
	$c2=intval($_POST['c2']);
	$c3=$c1+$c2;
	
	//＄nの値を決める
	for($n=0;$n<$c3;$n++){
        if(!empty($_POST["submit_list".$n])){ 
        	break;
        	}
	}
	
	$v1=0;
	if($n<$c1){
		$sql_list="select * from title";
		$stmt_list = array();
		foreach($mysqli->query($sql_list) as $a1) {
			if($v1!=$n+1){
        		array_push($stmt_list,$a1);
        		$v1++;
        	}
        }
        $title_id=htmlspecialchars($stmt_list[intval($v1-1)]['id']);
       
	}elseif($c1<=$n && $n<$c3){
		$v2=0;
        $search = htmlspecialchars($_POST['title_sch']);
        $stmt_sch = array();
        $sql_sch = "select * from title where title like '%$search%'";
        
        foreach($mysqli->query($sql_sch) as $a2) {
            if($v2!=$n-$c1){
            	array_push($stmt_sch,$a2);
            	$v2++;
            }
         }
         print_r($stmt_sch);
         $title_id=htmlspecialchars($stmt_sch[$v2]['id']);
         echo "v2=".$v2;
         echo "<br >";
    }
	
}else{
 		//end.phpから
          	$title_id=$_POST['title_id'];
          	echo $title_id;
}

//ここまで

$sql_title = "SELECT * FROM title WHERE id=$title_id";
$result_title = $mysqli->query($sql_title);
if($result_title === FALSE) {
	echo "error2";
}

while($val = mysqli_fetch_assoc($result_title)){
	$title_view= $val['title'];
	$detail_view=$val['detail'];
}

?>


<?php
    define("title", "vote");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>


<div class="center2">

    <div class="title">
            <span class="bold"><?php echo $title_view; ?></span>
            <span class="small"><?php echo $detail_view; ?></span>
    </div>

    <div class="vote">
    

<?php
$query = "SELECT * FROM sentaku WHERE id=$title_id";
$result = $mysqli->query($query) or die($mysqli->error);

while ($row = $result->fetch_assoc()) {
	$sentaku_id = $row['sentaku_id'];
	$sentaku_name = $row['sentaku_name'];
	$vote = $row['vote'];
?>

        <div class="border">
            <div class="b-in1">
                <?php echo $sentaku_name; ?>
            </div>
            <span id="num" class="b-in2"><?php echo $vote; ?></span>
            <button id="<?php echo $sentaku_id; ?>" name="<?php echo $sentaku_name; ?>">投票する</button>
        </div>

<?php
} // End of while
?>
    

<script type="text/javascript">
$(function() {

	    // buttonがクリックされたときに実行
	   $("button").click(function() {

			// buttonのIDを取得する
			var sentaku_id = $(this).attr("id");

			// buttonのname（キャラクター名）を取得する
			var sentaku_name = $(this).attr("name");

			// POST用のデータ準備：id=をつけないと、vote.phpの$_POST['id']で取得できない
			var voteData = 'id='+ sentaku_id;

			// span内の投票数を書き換える
			var thisButton = $(this).prev('#num');

			$.ajax({

				 type: "POST",
				 url: "vote.php",
				 data: voteData,

					 success: function(data) {
			 		// 処理が成功したら、thisButton内部を書き換える
					thisButton.html(data);
				}

			});

			return false;
		});

});
</script>

</div>

<div class="link">
    <a href="listvote.php">投票一覧</a>
    <p> | </p>
    <a href="index.php">TOPに戻る</a>
</div>
    
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>