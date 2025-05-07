<?php
session_start();
include 'db.php';

// 로그인 확인
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

// GET 방식으로 글 ID 받아오기
if (!isset($_GET["id"])) {
    echo "잘못된 접근입니다.";
    exit();
}

$post_id = $_GET["id"];

// 글 정보 조회
$stmt = $conn->prepare("SELECT posts.title, posts.content, posts.created_at, users.username 
                        FROM posts 
                        JOIN users ON posts.user_id = users.id 
                        WHERE posts.id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
} else {
    echo "존재하지 않는 글입니다.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 상세 보기</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>📄 글 상세 보기</h2>
<div class="view-box">
    <p><strong>제목:</strong> <?= htmlspecialchars($row["title"]) ?></p>
    <p><strong>작성자:</strong> <?= htmlspecialchars($row["username"]) ?></p>
    <p><strong>작성일:</strong> <?= $row["created_at"] ?></p>
    <hr>
    <p><?= nl2br(htmlspecialchars($row["content"])) ?></p>
</div>

<div class="view-buttons">
<?php
// 로그인한 사용자와 글 작성자가 같을 때만 수정/삭제 버튼 표시
if ($_SESSION["username"] === $row["username"]) {
    echo "<a href='edit.php?id=$post_id'>✏ 수정</a> | ";
    echo "<a href='delete.php?id=$post_id' onclick=\"return confirm('정말 삭제하시겠습니까?');\">🗑 삭제</a><br><br>";
}
?>

<a href="board.php">← 게시판으로 돌아가기</a>
</div>

</body>
</html>