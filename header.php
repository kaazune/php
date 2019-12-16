<?php 
session_start();

/*if(isset( $_SESSION["NAME"] )){
    echo "サインイン中です";
}elseif(!isset( $_SESSION["NAME"] )){
    echo "サインアウト中です";
}else{
    echo "error";
}*/

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo title; ?></title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="slick/slick-theme.css" rel="stylesheet" type="text/css">
    <link href="slick/slick.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
   
    <main id="barba-wrapper">
        <div class="barba-container">

    <header>
        <div class="heada">
            <a href="index.php"><img src="img/createvote.png"></a>
        </div>
        <div class="headb">
            <ul>
                <li><a href="#">How to</a></li>
                <li><a href="post.php">Create</a></li>
                <li><a href="listvote.php">Find</a></li>
                <li> <?php if(isset($_SESSION["NAME"])){ ?>
                        <a href="main.php">MY PAGE</a> 
                        <?php }else{ ?> 
                        <a href="login.php">Log in</a>
                        <?php } ?>
                </li>
            </ul>
        </div>
    </header>
    <div class="sukima"></div>