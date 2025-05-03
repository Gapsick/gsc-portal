<?php 
include "db.php";
include "functions.php";  // ✅ 공통 함수 사용

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자세히보기</title>
</head>
<body>

<h2><?= htmlspecialchars($row['title']) ?></h2>

<div class="content">
    <?= nl2br(htmlspecialchars($row['content'])) ?>
</div>

<br><br>

<div class="button-group">
    <!-- 삭제 버튼 -->
    <form action="request.php?action=delete" method="post" style="display:inline;">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <button type="submit">삭제</button>
    </form>

    <!-- 수정 버튼 -->
    <a href="edit.php?id=<?= $row['id'] ?>">
        <button type="button">수정</button>
    </a>

    <!-- 목록으로 -->
    <a href="main.php">
        <button type="button">목록으로</button>
    </a>
</div>

</body>
</html>
