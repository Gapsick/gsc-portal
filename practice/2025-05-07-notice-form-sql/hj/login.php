<?php
session_start();
include 'db.php';  // DB 연결

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 사용자 정보 조회
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // 로그인 성공
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            echo "🎉 로그인 성공!<br>";
            echo "<a href='board.php'>게시판으로 이동</a>";
        } else {
            echo " 비밀번호가 틀렸습니다.";
        }
    } else {
        echo " 존재하지 않는 사용자입니다.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<h2>로그인</h2>
<form action="login.php" method="post">
    아이디: <input type="text" name="username" required><br>
    비밀번호: <input type="password" name="password" required><br>
    <input type="submit" value="로그인">
</form>
