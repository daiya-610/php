<?php

session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // セッション情報を削除
    if(isset($_SESSION["email"])) {
        unset($_SESSION["email"]);
    }

    // SQLインジェクションを防ぐためにプリペアドステートメントを使用
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?"); // PHPのPDO（PHP Data Objects）を使用してプリペアドステートメントを作成する構文, SELECT * FROM users WHERE email = ? というSQLクエリの中の ? はプレースホルダーとして、後でバインドされる値を表します。これにより、SQLインジェクション攻撃から保護され、安全なクエリを実行することができます。
    $stmt->bind_param("s", $email); // SQLインジェクション攻撃対策 - プリペアドステートメントにパラメータをバインドするメソッド、”s”はバインドするパラメータのデータ型を示しており、ここでは文字列を表す。
    
    $stmt->execute(); // プリペアドステートメントを実行し、その結果を取得するためのメソッド
    $result = $stmt->get_result(); // 実行されたクエリの結果を取得するためのメソッド - 実行結果を取得して後続の処理に使用することができる。

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

    $stmt->close();
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