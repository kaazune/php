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
	
		<h2>入力</h2>
	
		<form action="end.php" method="post">
		<table>
			<tr><th>name</th>
			<td><input type="text" name="name" placeholder="サンリオ人気投票" required></td></tr>
			
			<tr><th>vote</th>
			<td><input type="text" name="vote"></td></tr>
		</table>
		<input type="submit" name="submit" value="次へ" >
		</form>
		
	</body>
	
</html>
