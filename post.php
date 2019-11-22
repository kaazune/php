<?php 

ini_set('display_errors',"On");

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>投票システム</title>
	</head>
	
	<body>
	
		<h2>title入力</h2>
	
		<form action="post2.php" method="post">
		<table>
			<tr><th>投票のタイトル</th>
			<td><input type="text" name="title" placeholder="20文字まで" required></td></tr>
			
			<tr><th>選択肢数</th>
			<td><input type="text" name="num" placeholder="2~5" required></td></tr>
			
			<tr><th>投票の概要</th>
			<td><textarea name="detail" placeholder="100文字まで"></textarea></td></tr>
		</table>
		<input type="submit" name="submit_title" value="次へ" >
		</form>
		
	</body>
	
</html>
