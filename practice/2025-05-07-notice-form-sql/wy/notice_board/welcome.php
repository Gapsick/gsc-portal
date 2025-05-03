<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/welcome.css">
    <title>Welcome</title>
</head>
<body>
    <div class=" container">
        <h1>환영합니다, <?php echo htmlspecialchars($_SESSION['username']); ?>님!</h1>

        <p><a class="log_out" href="logout.php">로그아웃</a></p>
        <p><a href="list.php">게시판 목록으로 이동</a></p>
    </div>
</body>
</html>
