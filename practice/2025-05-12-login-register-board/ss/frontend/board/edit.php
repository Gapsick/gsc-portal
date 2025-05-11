<?php
include "../../backend/db/db.php";
session_start();

$id = $_GET['id'] ?? null;
if (!$id) die("유효하지 않은 접근입니다.");

$stmt = $conn->prepare("SELECT * FROM board WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if ($_SESSION['user_name'] !== $post['author']) {
    die("수정 권한이 없습니다.");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 수정</title>
</head>
<body>
    <h2>게시글 수정</h2>
    <form action="../../backend/board/update_board.php" method="post">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>
        <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>
        <button type="submit">수정 완료</button>
    </form>
    <br>
    <a href="view.php?id=<?= $post['id'] ?>">돌아가기</a>
</body>
</html>
