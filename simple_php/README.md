## 1.データベース構築
### 1-1 ログイン
```
mysql --user=root --password
```

### 1-2 データベース作成
```
create database simple;
```

### 1-3 データベース選択
```
use simple;
```

### 1-4 テーブルの確認
```
show tables;
```

### 1-5 テーブルの作成
```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

### 1-6 ユーザーの追加
```
INSERT INTO users (username, password) VALUES ('user1', 'password');
```