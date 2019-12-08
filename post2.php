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


<?php
    define("title", "step2");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>
<div class="center">
    <div class="step2">
        <img src="img/step2.png">
        <p></p>
    </div>

	<?php 
		$sum=1;
		while($sum<=$num):
		?>
		<form action="end.php" method="post">
		
            <label>選択肢名<?php echo $sum ?>つ目</label>
			<input type='hidden' name='num' value='<?php echo $num; ?>' >
			<input type='hidden' name='title_id' value=' <?php echo $title_id; ?> ' >
			<input type="text" name="<?php echo "sentaku_name".$sum; ?>"placeholder="20文字まで" required>
		<?php 
			$sum++; 
			endwhile; ?>
		
		<input type="submit" name="submit_name" value="次へ" class="button">
        </form>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>