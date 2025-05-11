<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 작성</title>
</head>
<body>
    <h2>게시글 작성</h2>
    <form action="../../backend/board/save_board.php" method="post">
        <input type="text" name="title" placeholder="제목" required><br><br>
        <textarea name="content" placeholder="내용을 입력하세요" required></textarea><br><br>
        <input type="hidden" name="author" value="<?= htmlspecialchars($_SESSION['user_name']) ?>">
        <button type="submit">등록</button>
    </form>

    <br>
    <a href="board.php">게시판으로 돌아가기</a>
</body>
</html>
