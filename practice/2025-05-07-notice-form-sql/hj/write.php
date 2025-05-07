<?php
session_start();
include 'db.php';

// 로그인 체크
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

// POST 요청 시: 글 저장
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $content);

    if ($stmt->execute()) {
        header("Location: board.php");
        exit();
    } else {
        echo "글 저장 실패: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글쓰기</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>✍ 글쓰기</h2>
<form action="write.php" method="post">
    제목: <input type="text" name="title" required><br><br>
    내용:<br>
    <textarea name="content" rows="10" cols="50" required></textarea><br><br>
    <input type="submit" value="글 등록">
</form>

<a href="board.php" class="button-link">← 게시판으로 돌아가기</a>

</body>
</html>