<?php

session_start();

// データベース接続
$servername = "localhost"; // データベースのホスト名
$username = "root"; // データベースのユーザー名
$password = "password"; // データベースのパスワード
$dbname = "simple"; // データベース名

$conn = new mysqli($servername, $username, $password, $dbname);

// データベース接続エラーチェック
if($conn->connect_error) {
    die("データベース接続エラー：" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQLクエリを構築してメールアドレスとパスワードをチェック
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // 結果が1行の場合はログイン成功としてセッションを設定
    if ($result->num_rows == 1) {
        $_SESSION["email"] = $email;
        echo "ログインに成功しました。";
    } else {
        echo "メールアドレスまたはパスワードが正しくありません。";
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="email">メールアドレス</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="password">パスワード：</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="ログイン">
    </form>
</body>
</html>