<?php
ini_set('display_errors',"On");
header("Content-type: text/html; charset=utf-8");

$host = "mysql140.phy.lolipop.lan";
$username = "LAA1119419";
$password = "root";
$dbname = "LAA1119419-sanrio";

$mysqli = new mysqli($host, $username, $password, $dbname);
$mysqli->set_charset("utf8");

if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
}else{
	$mysqli->set_charset("utf-8");
}

?>