<?php

// データベース接続
$servername = "localhost"; // データベースのホスト名
$username = "root"; // データベースのユーザー名
$password = "password"; // データベースのパスワード
$dbname = "simple"; // データベース名

// MySQLデータベースに接続するためのオブジェクトを作成
$conn = new mysqli($servername, $username, $password, $dbname);

// データベース接続エラーチェック
if($conn->connect_error) {
    die("データベース接続エラー：" . $conn->connect_error);
}

?>