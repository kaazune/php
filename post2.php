<?php 

ini_set('display_errors',"On");

include("config.php");
		
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if((!isset($_POST['title'])) || ($_POST['title']==="")){
				echo "投票のタイトルが入力されていません";
			}else if((!isset($_POST['num'])) || ( $_POST['num']==="")){
				echo "選択肢数が入力されていません";
			}else{
				$title=$_POST['title'];
				$num=$_POST['num'];
				$detail=$_POST['detail'];
				$stmt=$mysqli->prepare("INSERT INTO title(title,num,detail) VALUES(?,?,?)");
				
			
			if($stmt){
				//定義する要素数を増やすたびにsを増やす↓
				$stmt->bind_param('sss',$title,$num,$detail);
		
				if(!$stmt->execute()){
					echo $stmt->errno . $stmt->error;
				}
				$title_id=$stmt->insert_id;
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
	
		<h2>sentaku入力</h2>
	  
	<?php 
		$sum=1;
		while($sum<=$num):
		?>
		<form action="end.php" method="post">
		<table>
		
			<tr><th>選択肢名<?php echo $sum ?> </th>
			<input type='hidden' name='num' value='<?php echo $num; ?>' >
			<input type='hidden' name='title_id' value=' <?php echo $title_id; ?> ' >
			<td><input type="text" name="<?php echo "sentaku_name".$sum; ?>"placeholder="20文字まで" required></td></tr>
		<?php 
			$sum++; 
			endwhile; ?>
		
		</table>
		<input type="submit" name="submit_name" value="次へ" >
		</form>
		
		
		
	</body>
	
</html>
