<?php
session_start();
include_once __DIR__ . '/../db/db_board.php';

$notices = getAllNotices();

$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
if ($isLoggedIn){
    $userId = $_SESSION['userId'] ?? 'error';
}else{
    header('Location: ../user/login.php');
    exit;
}
?>

<!-- 메인 -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>
<body>
    <h1>공지사항</h1>
    <p><?= htmlspecialchars($userId) ?>님!</p>
    <form action="../user/logout.php" method="POST">
        <button type="submit">로그아웃</button>
    </form>


    <a href="write.php">글쓰기</a>
    <ol>
        <!-- fetch_assoc로 한 게시씩 row에 대입해 출력 -->
        <?php while ($row = $notices->fetch_assoc()): ?>
            <li>
                <a href="view.php?id=<?= $row['id'] ?>">
                    <!-- htmlspecialchars() : XSS 방지, 태그 무력화 -->
                    <?= htmlspecialchars($row['title']) ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ol>
</body>
</html>
