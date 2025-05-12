<?php
session_start();

require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/board.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    exit('잘못된 접근입니다.');
}

try {
    $conn = connectDB();
    $post = getPostById($conn, $id);
    $conn->close();

    if (!$post) {
        exit('존재하지 않는 게시글입니다.');
    }
} catch (Exception $e) {
    exit("오류 발생: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <p><strong>작성자:</strong> <?= htmlspecialchars($post['username']) ?></p>
    <p><strong>작성일:</strong> <?= $post['created_at'] ?></p>
    <hr>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

    <hr>
    <a href="list.php">목록으로</a>

    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
    <a href="edit_form.php?id=<?= $post['id'] ?>">수정</a>
    <?php endif; ?>

    <form action="delete.php" method="post" style="display:inline;" onsubmit="return confirm('정말 삭제할까요?');">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <button type="submit">삭제</button>
    </form>


</body>
</html>
