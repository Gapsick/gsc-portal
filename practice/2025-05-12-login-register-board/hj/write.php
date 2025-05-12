<?php
session_start();
include "db.php";

// 로그인 체크
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

// 폼 전송 시
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];  // 누가 썼는지

    // 글 저장 쿼리
    $sql = "INSERT INTO posts (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    $result = $conn->query($sql);

    if ($result) {
        echo "✅ 글 등록 성공! <a href='board.php'>목록으로</a>";
    } else {
        echo "❌ 실패: " . $conn->error;
    }
}
?>

<!-- 글쓰기 폼 -->
<h2>✍ 글쓰기</h2>
<form method="post">
    제목: <input type="text" name="title"><br><br>
    내용:<br>
    <textarea name="content" rows="5" cols="40"></textarea><br><br>
    <input type="submit" value="등록하기">
</form>
