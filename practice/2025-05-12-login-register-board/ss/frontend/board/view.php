<?php
include "../../backend/db/db.php";
session_start();

// 로그인 안 한 사용자 접근 제한
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/index.html");
    exit;
}

// URL 파라미터에서 게시글 ID 받기
$post_id = $_GET['id'] ?? null;

if (!$post_id) {
    die("유효하지 않은 접근입니다.");
}

// DB에서 해당 게시글 가져오기
$stmt = $conn->prepare("SELECT * FROM board WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    die("게시글을 찾을 수 없습니다.");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 보기</title>
</head>
<body>
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <p><strong>작성자:</strong> <?= htmlspecialchars($post['author']) ?></p>
    <p><strong>작성일:</strong> <?= $post['created_at'] ?></p>
    <hr>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <hr>
    <a href="board.php">목록으로</a>

    <!-- 수정/삭제는 본인이 작성한 글일 경우에만 -->
    <?php if ($_SESSION['user_name'] === $post['author']): ?>
        | <a href="edit.php?id=<?= $post['id'] ?>">수정</a>
        | 
        <form action="../../backend/board/delete_board.php" method="post">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <button type="submit" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</button>
        </form>
    <?php endif; ?>

</body>
</html>
