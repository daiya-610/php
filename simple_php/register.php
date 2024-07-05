<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { // HTTPリクエストがPOSTメソッドで送信されたかどうかをチェック
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // パスワードをハッシュ化
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ユーザーをデータベースに追加
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    if ($conn->query($sql) === TRUE) { // データベースクエリの実行が成功したかどうかをチェック
        echo "ユーザー登録が完了しました。";
        header("Location: login.php");
        exit();
    } else {
        echo " エラー：" . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}