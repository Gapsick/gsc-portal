<?php
include "db.php"; // DB 연결
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if($stmt->execute()) {
        echo "회원가입 성공! <a href='login.php'>로그인 하러가기</a>";
    } else {
        echo "회원가입 실패: " . $stmt->error;
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>회원가입</h2>
<form action="register.php" method="post">
    아이디: <input type="text" name="username" required><br>
    비밀번호: <input type="password" name="password" required><br>
    <input type="submit" value="회원가입">
</form>