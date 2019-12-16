<?php 

ini_set('display_errors',"On");

include("config.php");

define("title", "Complete | Create Vote");
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');


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
			
			if(isset($_FILES['upimg'.$x])){
				
				//格納するsentaku_idを取得
				$sql_max="select * from sentaku where sentaku_id=(select max(sentaku_id) from sentaku)";
				$stmt_max= array();
				foreach ($mysqli->query($sql_max) as $a1) {
        		array_push($stmt_max,$a1);
				}
				$sentaku_id= intval($stmt_max["0"]["sentaku_id"]);
			
				//画像を格納する
				$img_name =$_FILES['upimg'.$x]['name'];
				$new_name='./upload/'."img".$sentaku_id;
				//拡張子を判定
				switch (exif_imagetype( $_FILES ['upimg'.$x] ['tmp_name'] )) {
        			case IMAGETYPE_JPEG :
            			$new_name .= '.jpg';
            			break;
        			case IMAGETYPE_GIF :
           			 	$new_name .= '.gif';
            			break;
        			case IMAGETYPE_PNG :
            			$new_name .= '.png';
            			break;
        			default :
            			echo "error";
            			exit ();
    			}
				move_uploaded_file($_FILES['upimg'.$x]['tmp_name'],$new_name);
				
				//dbにパスを格納
				$sql_img="update sentaku set img='$new_name' where sentaku_id=$sentaku_id";
				$stmt_img=$mysqli->query($sql_img);
								
				}
			$x++;
		}
	}


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
		
		
		
		