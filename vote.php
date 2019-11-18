<?php
include("config.php");

// POSTされたときに下記を実行
if( $_POST['id'] ) {

	$id = $_POST['id'];
	$id = $mysqli->real_escape_string($id);

    if ( !isset($_COOKIE['voted']) ) {
        setcookie("voted", "voted", time()+3);
        
        // 投票数をアップデートする
	    $sql = "UPDATE sanrio_vote SET vote = vote+1  WHERE id='$id'";
	    $mysqli->query( $sql);
    }

	// 投票数を取得する
	$result = $mysqli->query("SELECT vote FROM sanrio_vote WHERE id='$id'");
	$row=$result->fetch_assoc();

	$vote_value=$row['vote'];
	echo $vote_value;

}
?>