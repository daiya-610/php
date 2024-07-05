<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
</head>
<body>
    <h2>ユーザー登録フォーム</h2>
    <form method="post" action="register.php">
        <label for="username">ユーザー名：</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="email">メールアドレス：</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">パスワード：</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="登録">
    </form>
</body>
</html>