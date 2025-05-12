<?php
session_start();
include "db.php";

// 로그인 안 했으면 차단
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

// 주소에서 글 번호 받기 (예: view.php?id=3)
if (!isset($_GET["id"])) {
    echo "잘못된 접근입니다.";
    exit();
}
$post_id = $_GET["id"];

// DB에서 글 정보 가져오기 (작성자 이름까지)
$sql = "SELECT posts.title, posts.content, posts.created_at, users.username
        FROM posts
        JOIN users ON posts.user_id = users.id
        WHERE posts.id = $post_id";
$result = $conn->query($sql);

// 글이 존재할 경우만 출력
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
} else {
    echo "글을 찾을 수 없습니다.";
    exit();
}
?>

<!-- 글 보기 화면 -->
<h2>📄 글 상세 보기</h2>
<p><strong>제목:</strong> <?= htmlspecialchars($row["title"]) ?></p>
<p><strong>작성자:</strong> <?= htmlspecialchars($row["username"]) ?></p>
<p><strong>작성일:</strong> <?= $row["created_at"] ?></p>
<hr>
<p><?= nl2br(htmlspecialchars($row["content"])) ?></p>
<hr>

<!-- 본인 글일 경우만 수정/삭제 표시 -->
<?php if ($_SESSION["username"] === $row["username"]): ?>
    <a href="edit.php?id=<?= $post_id ?>">✏ 수정</a> |
    <a href="delete.php?id=<?= $post_id ?>" onclick="return confirm('삭제할까요?');">🗑 삭제</a> |
<?php endif; ?>
<a href="board.php">← 목록으로 돌아가기</a>
