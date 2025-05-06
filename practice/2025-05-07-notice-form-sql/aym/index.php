<?php
    require_once 'db_connect.php';
    $conn = connectDB();

    // 모든 데이터 조회 함수 호출
    $notices = getAllNotices($conn);
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
