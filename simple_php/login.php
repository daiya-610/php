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
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQLクエリを構築してユーザー名とパスワードをチェック
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // 結果が1行の場合はログイン成功としてセッションを設定
    if ($result->num_rows == 1) { // データベースから取得した結果が1行のみであることを確認(ユーザー名とパスワードを使用してログインする場合、データベース内には同じユーザー名とパスワードを持つユーザーは1人だけであることが期待されるため。)
        $_SESSION["username"] = $username;
        echo "ログインに成功しました。";
    } else {
        echo "ユーザー名またはパスワードが正しくありません。";
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
        <label for="username">ユーザー名：</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">パスワード：</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="ログイン">
    </form>
</body>
</html>