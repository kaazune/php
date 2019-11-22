<?php 

ini_set('display_errors',"On");

include("config.php");

	$num=$_POST['num'];
	$title_id=$_POST['title_id'];
	
	
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$x=1;
			while($x<=$num){
				$sentaku_name=$_POST["sentaku_name".$x];
				echo $sentaku_name;
				
				if((!isset($_POST["sentaku_name".$x]) )|| ($_POST["sentaku_name".$x]==="")){
					echo "選択肢".$x."が入力されていません";
				}else{
					$sentaku_name=$_POST["sentaku_name".$x];
					$stmt=$mysqli->prepare("INSERT INTO sentaku(id,sentaku_name) VALUES(?,?)");
				if($stmt){
					//定義する要素数を増やすたびにsを増やす↓
					$stmt->bind_param('ss',$title_id,$sentaku_name);
		
					if(!$stmt->execute()){
					echo $stmt->errno . $stmt->error;
				}
					$stmt->close();
				}else{
					echo $mysqli->errno . $mysqli->error;
				}
			}
			$x++;
		}
	}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>投票システム</title>
	</head>
	
	<body>
	<form action="viewvote.php" method="post">
	<input type='hidden' name='title_id' value='<?php echo $title_id; ?> ' >
	<input type="submit" name="submit_name" value="次へ" >
	<!--<a href="viewvote.php">作成した投票をみる</a> -->
	</form>
	<br />
	<a href="listvote.php">他の投票を見る</a>
	<br />
	<a href="post.php">他の投票を作成する</a>
	

	</body>
	
</html>

		
		
		
		