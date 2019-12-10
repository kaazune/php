<?php 

ini_set('display_errors',"On");

include("config.php");

	$num=$_POST['num'];
	$title_id=$_POST['title_id'];
	
	
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$x=1;
			while($x<=$num){
				$sentaku_name=$_POST["sentaku_name".$x];
				//echo $sentaku_name;
				
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


<?php
    define("title", "Complete");
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
?>


<div class="center">
    <div class="comp">
        <img src="img/complete.png">
        <p></p>
    </div>
    
	<form action="viewvote.php" method="post" class="long">
        <input type='hidden' name='title_id' value='<?php echo $title_id; ?> ' >
        <input type="submit" name="submit_name" value="作成した投票をみる！" class="button">
        <!--<a href="viewvote.php">作成した投票をみる</a> -->
	</form>
    
	<br>
    
	<a href="listvote.php">他の投票を見る</a>
	
    <br>
    
	<a href="post.php">他の投票を作成する</a>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>
		
		
		
		