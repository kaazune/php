<?php
// エラーを出力する
ini_set('display_errors', "On");

ob_start();
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>サンリオ人気投票</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<?php

$query = "SELECT * FROM sanrio_vote";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
	$id = $row['id'];
	$character_name = $row['character_name'];
	$vote = $row['vote'];
    $sex = $row['sex'];
    $personality = $row['personality'];
    $birthday = $row['birthday'];
    $img_path = $row['img_path'];
?>

<p>
	<img src="img/<?php echo $img_path; ?>"><?php echo $character_name; ?>：
	<span id="num"><?php echo $vote; ?></span>
	<button id="<?php echo $id; ?>" name="<?php echo $character_name; ?>">投票する</button>
</p>

<?php
} // End of while
?>
    

<script type="text/javascript">
$(function() {

	    // buttonがクリックされたときに実行
	   $("button").click(function() {

			// buttonのIDを取得する
			var id = $(this).attr("id");

			// buttonのname（キャラクター名）を取得する
			var character_name = $(this).attr("name");

			// POST用のデータ準備：id=をつけないと、vote.phpの$_POST['id']で取得できない
			var voteData = 'id='+ id;

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
</body>
</html>