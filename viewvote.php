<?php
// エラーを出力する
/*
ini_set('display_errors', "On");
*/
ob_start();
include('config.php');

define("title", "vote | Create Vote");
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');

if(!empty($_POST['c1'])){
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
	$v2=0;
	
	if($n<$c1){
		
		//みんなの投票から
        include('./fromlist.php');
       
	}elseif($c1<=$n && $n<$c3){
    
    	//検索結果から
    	include('./fromsearch.php');
    
    }else{
    	
    	//おすすめの投票から
		for($n=0;$n<10;$n++){
			if(!empty($_POST["submit_recd".$n])){
				$title_id=$_POST["title_id".$n]+1;
        	 }
        }
	}
	//mypageから
}elseif(!empty($_POST['c_id'])){

	$c_id=$_POST['c_id'];
	for($n=0;$n<$c_id;$n++){
        if(!empty($_POST["submit_user".$n])){ 
        	break;
        	}
	}
	
	$user_id=intval($_SESSION['ID']);
	$sql_userid = "select * from title where user_id=$user_id";
	$stmt_userid=array();
	$c4=0;
    foreach ($mysqli->query($sql_userid) as $a4) {
    	if($n>=$c4){
        	array_push($stmt_userid,$a4);
        	$c4++;
        }
	}
	 $title_id=htmlspecialchars($stmt_userid[$c4-1]['id']);
	
}else{
 		//end.phpから
          	$title_id=$_POST['title_id'];
}

$sql_title = "SELECT * FROM title WHERE id=$title_id";
$result_title = $mysqli->query($sql_title);
if(!$result_title) {
	echo "error2";
}

while($val = mysqli_fetch_assoc($result_title)){
	$title_view= $val['title'];
	$detail_view=$val['detail'];
}

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
	$img=$row['img'];
?>

        <div class="border">
            <div class="b-in1">
                <?php echo $sentaku_name; ?>
            </div>
            <span id="num" class="b-in2"><?php echo $vote; ?></span>
            
            <button id="<?php echo $sentaku_id; ?>" name="<?php echo $sentaku_name; ?>" class="button2">投票する</button>
            <img src="<?php echo $img; ?>" >
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
			var thisButton = $(this).prev('.b-in2');

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