<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 상세</title>
</head>
<body>
    <h2>게시글 상세보기</h2>

    <h3><?= htmlspecialchars($post['title']) ?></h3>
    <p><strong>작성자:</strong> <?= htmlspecialchars($post['username']) ?></p>
    <p><strong>작성일:</strong> <?= $post['created_at'] ?></p>
    <hr>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <hr>

    <p>
        <a href="index.php?action=list">목록으로</a>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
            | <a href="index.php?action=editForm&id=<?= $post['id'] ?>">수정</a>
            | <a href="index.php?action=delete&id=<?= $post['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
        <?php endif; ?>
    </p>
</body>
</html>
