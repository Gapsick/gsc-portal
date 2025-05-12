<?php
require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/board.php';

try {
    $conn = connectDB();
    $result = getPostList($conn);
} catch (Exception $e) {
    die("오류 발생: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 목록</title>
</head>
<body>
    <h2>게시글 목록</h2>
    <a href="write_form.html">글쓰기</a>
    <hr>

    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <a href="view.php?id=<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['title']) ?>
                    </a>
                    - 작성자: <?= htmlspecialchars($row['username']) ?>
                    - 작성일: <?= $row['created_at'] ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>등록된 게시글이 없습니다.</p>
    <?php endif; ?>

</body>
</html>