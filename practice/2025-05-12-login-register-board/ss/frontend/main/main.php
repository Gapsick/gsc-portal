<?php 
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
    <h2><?= htmlspecialchars($_SESSION['user_name']) ?>님 환영합니다</h2>

    <!-- 게시판 이동 -->
    <button onclick="location.href='../board/board.php'">게시판 바로가기</button>

    <!-- 로그아웃 -->
    <form action="../../backend/login/logout.php" method="post">
    <button type="submit">로그아웃</button>
    </form>
</body>
</html>