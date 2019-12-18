<?php
ob_start();
include("config.php");
define("title", "Log in | Create Vote");
require_once($_SERVER['DOCUMENT_ROOT'] . '/header.php');
$errorMessage = '';

#ログインボタンが押された場合
if (isset($_POST["login"])) {
    #ユーザの入力チェック
    if (empty($_POST["userid"])) {  #emptyは値が何も入っていないとき
        $errorMessage = 'ユーザーネームが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        #入力したユーザIDを格納
        $userid = $_POST["userid"];

        #ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql:host=%s; dbname=%s; charset=utf8', $host, $dbname);
        #エラー処理
        try {
            $pdo = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM UserData WHERE name = ?');
            $stmt->execute(array($userid));

            $p = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($p, $row['password'])) {
                    session_regenerate_id(true);
                    #入力したIDのユーザー名を取得する
                    $id = $row['id'];
                    $sql = "SELECT * FROM UserData WHERE id = $id";
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  #ユーザー名を取得
                    }
                    $_SESSION["NAME"] = $row['name'];
                    $_SESSION["ID"]=$id;
                    header("Location:main.php");  #メイン画面へ遷移
                    exit();  #処理終了
                    #認証成功なら、セッションIDを新規に発行する
                }
                
                else {
                    #認証失敗
                    $errorMessage = 'ユーザーIDまたはパスワードが間違っています';
                }
                
            } else {
                #該当データなし
                $errorMessage = 'ユーザーIDまたはパスワードが間違っています';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            #デバックするときに$e->getMessage() でエラー内容を参照可能
        }
    }
}
?>

<div class="login center">
        <h1>ログイン</h1>
        <form id = "loginForm" name="loginForm" action="" method="post" class="login-form">
            <div class="label">
                <label for="userid">ユーザーネーム</label>
                <input type = "text" id="userid" name="userid"value="<?php if (!empty($_POST["username"])) {
                echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>" autocomplete="off">
            </div>
            
            <div class="label">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" value="" autocomplete="off">
            </div>   
               
            <input type="submit" id="login" name="login" value="ログイン">
            
            <div class="error"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
        </form>
        <div class="new">
            <a href="signup.php">新規登録</a>
        </div>
</div>

<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/footer.php');
?>


    