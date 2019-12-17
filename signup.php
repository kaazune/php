<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
include("config.php");

#エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";


if (isset($_POST["signUp"])) {
    #ユーザIDの入力チェック
    
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage = 'ユーザーネームが未入力です';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です';
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
        #入力したユーザIDとパスワードを格納
        
        $u = $_POST["username"];
        $p = $_POST["password"];

        #ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $host, $dbname);

        #エラー処理
        try {
            $pdo = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO UserData(name, password) VALUES (?, ?)");

            $stmt->execute(array($u, password_hash($p, PASSWORD_DEFAULT)));
            
            $userid = $pdo->lastinsertid(); 
            
            header('Location: login.php');
            
        } catch (PDOException $e) {
            if($e->getCode()==23000){
                $errorMessage='このUSER NAMEは既に使われています';
            }else{
            $errorMessage = 'データベースエラー';
            echo $e->getMessage();
            #デバッグのときに$e->getMessage() でエラー内容を参照可能
            }
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードが一致しません';
    }
    
}
?>

       
<div class="signup center">
    <h1>新規ユーザー登録</h1>
    <form id="loginForm" name="loginForm" action="" method="POST" class="signup-form">
        <div class="label">
            <label for="username">ユーザーネーム</label>
            <input type="text" id="username" name="username" value="<?php if (!empty($_POST["username"]))
            {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>" autocomplete="off">
        </div>
        
        <div class="label">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" value="" autocomplete="off">
        </div>
        
        <div class="label">
            <label for="password2">パスワードを再入力してください</label>
            <input type="password" id="password2" name="password2" autocomplete="off">
        </div>
        
        <div class="error">
            <?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?>
        </div>
        <div class="error">
            <?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?>
        </div>
        
        <input type="submit" id="signUp" name="signUp" value="新規登録">
    </form>
    
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>