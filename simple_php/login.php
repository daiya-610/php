<?php

session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQLクエリを構築してメールアドレスとパスワードをチェック
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    // 結果が1行の場合はログイン成功としてセッションを設定
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            $_SESSION["email"] = $email;
            echo "ログインに成功しました。";
        } else {
            echo "メールアドレスまたはパスワードが正しくありません。 - 1";
        }
    } else {
        echo "メールアドレスまたはパスワードが正しくありません。 - 2";
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
    <a href="registration_form.php">新規登録</a>
</body>
</html>