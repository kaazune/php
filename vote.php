<?php
include("config.php");

// POSTされたときに下記を実行
if( $_POST['sentaku_id'] ) {

	$sentaku_id = $_POST['sentaku_id'];
	$sentaku_id = $mysqli->real_escape_string($sentaku_id);

    if ( !isset($_COOKIE['voted']) ) {
        setcookie("voted", "voted", time()+3);
        
        // 投票数をアップデートする
	    $sql = "UPDATE sentaku SET vote = vote+1  WHERE sentaku_id='$sentaku_id'";
	    $mysqli->query( $sql);
    }

	// 投票数を取得する
	$result = $mysqli->query("SELECT vote FROM sentaku WHERE sentaku_id='$sentaku_id'");
	$row=$result->fetch_assoc();

	$vote_value=$row['vote'];
	echo $vote_value;

}
?>