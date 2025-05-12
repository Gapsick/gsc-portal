<?php
session_start();
require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/board.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) exit('잘못된 접근입니다.');

$conn = connectDB();
$post = getPostById($conn, $id);
$conn->close();

if (!$post || $post['user_id'] != $_SESSION['user_id']) {
    exit('수정 권한이 없습니다.');
}
?>

<!DOCTYPE html>
<html lang="ko">
<head><meta charset="UTF-8"><title>글 수정</title></head>
<body>
<h2>글 수정</h2>
<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    제목: <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
    내용:<br>
    <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
    <button type="submit">수정 완료</button>
</form>
</body>
</html>
