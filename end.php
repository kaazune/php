<?php 

ini_set('display_errors',"On");

include("config.php");
		
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(!isset($_POST['name']) || $_POST['name']===""){
				echo "nameが入力されていません";
			}else if(!isset($_POST['vote']) ||  $_POST['vote']===""){
				echo "voteが入力されていません";
			}else{
				$name=$_POST['name'];
				$vote=$_POST['vote'];
				$stmt=$mysqli->prepare("INSERT INTO vote_db(name,vote) VALUES(?,?)");
			
			if($stmt){
				//定義する要素数を増やすたびにsを増やす↓
				$stmt->bind_param('ss',$name,$vote);
		
				if($stmt->execute()){
					echo "登録しました";
				}else{
					echo $stmt->errno . $stmt->error;
				}
				$stmt->close();
			}else{
				echo $mysqli->errno . $mysqli->error;
			}
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
	
	<a herf="">

	</body>
	
</html>

		
		
		
		