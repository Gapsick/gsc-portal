<?php
include "db.php";
include "functions.php";  // 공통 함수 불러오기

$id = $_GET['id'] ?? null;
$row = get_board_by_id($conn, $id);

if (!$row) {
    exit("해당 게시글을 찾을 수 없습니다.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>글 수정</title>
</head>
<body>

<h2>글 수정</h2>

<form method="post" action="request.php?action=update">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">

  <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>

  <textarea name="content" rows="10" required><?= htmlspecialchars($row['content']) ?></textarea>

  <button type="submit">수정 완료</button>
  <a href="main.php"><button type="button">취소</button></a>
</form>

</body>
</html>
