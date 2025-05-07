<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

if (!isset($_GET["id"])) {
    echo "잘못된 접근입니다.";
    exit();
}

$post_id = $_GET["id"];
$user_id = $_SESSION["user_id"];

// 수정 대상 글 불러오기
$stmt = $conn->prepare("SELECT title, content, user_id FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "존재하지 않는 글입니다.";
    exit();
}

$post = $result->fetch_assoc();

// 다른 사람이 쓴 글이면 접근 차단
if ($post["user_id"] != $user_id) {
    echo "자신의 글만 수정할 수 있습니다.";
    exit();
}

// POST 방식이면 수정 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST["title"];
    $new_content = $_POST["content"];

    $update = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $update->bind_param("ssi", $new_title, $new_content, $post_id);

    if ($update->execute()) {
        header("Location: board.php");
        exit();
    } else {
        echo "수정 실패: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 수정</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>✏ 글 수정</h2>
<form action="edit.php?id=<?= $post_id ?>" method="post">
    제목: <input type="text" name="title" value="<?= htmlspecialchars($post["title"]) ?>" required><br><br>
    내용:<br>
    <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($post["content"]) ?></textarea><br><br>
    <input type="submit" value="수정 완료">
</form>

<a href="board.php">← 게시판으로 돌아가기</a>

</body>
</html>