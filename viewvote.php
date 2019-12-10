<?php
// エラーを出力する
ini_set('display_errors', "On");

ob_start();
include('config.php');

$title_id=$_POST['title_id'];
$sql_title = "SELECT * FROM title WHERE id=$title_id";
$result_title = $mysqli->query($sql_title);
foreach($result_title as $val) {
    $title_view= $val['title'];
    $detail_view=$val['detail'];
}

?>


<?php
    define("title", "vote");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>


<div class="center">

<div class="title">
        <span class="bold"><?php echo $title_view; ?></span>
        <span class="small"><?php echo $detail_view; ?></span>
</div>

<div class="vote">
    

<?php
$query = "SELECT * FROM sentaku WHERE id=$title_id";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
	$sentaku_id = $row['sentaku_id'];
	$sentaku_name = $row['sentaku_name'];
	$vote = $row['vote'];
?>

<div class="border">
    <div class="b-in1">
        <?php echo $sentaku_name; ?>
    </div>
    <div class="b-in2">
        <span id="num"><?php echo $vote; ?></span>
    </div>
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
			var thisButton = $(this).prev('span');

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