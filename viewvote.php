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
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>投票システム</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<table>
			<tr><th>投票のタイトル</th>
			<td><?php echo $title_view; ?></td></tr>
			
			<tr><th>投票の概要</th>
			<td><?php echo $detail_view; ?></td></tr>
</table>

<?php
$query = "SELECT * FROM sentaku WHERE id=$title_id";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
	$sentaku_id = $row['sentaku_id'];
	$sentaku_name = $row['sentaku_name'];
	$vote = $row['vote'];
?>



<p>
	<?php echo $sentaku_name; ?>：
	<span id="num"><?php echo $vote; ?></span>
	<button id="<?php echo $sentaku_id; ?>" name="<?php echo $sentaku_name; ?>">投票する</button>
</p>

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

<a href="listvote.php">投票一覧</a>
	<br>
<a href="index.html">TOPに戻る</a>

</body>
</html>