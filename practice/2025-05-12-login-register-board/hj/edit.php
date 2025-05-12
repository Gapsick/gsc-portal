<?php
session_start();
include "db.php";

// 로그인 확인
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용하세요. <a href='login.php'>로그인</a>";
    exit();
}

// 글 번호 받기 (예: edit.php?id=3)
if (!isset($_GET["id"])) {
    echo "잘못된 접근입니다.";
    exit();
}
$post_id = $_GET["id"];

// 글 정보 불러오기
$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows !== 1) {
    echo "해당 글이 없습니다.";
    exit();
}

$row = $result->fetch_assoc();

// 본인 글인지 확인
if ($row["user_id"] != $_SESSION["user_id"]) {
    echo "자신의 글만 수정할 수 있어요.";
    exit();
}

// 수정 요청이 들어왔을 때
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST["title"];
    $new_content = $_POST["content"];

    // UPDATE 쿼리 실행
    $update_sql = "UPDATE posts SET title='$new_title', content='$new_content' WHERE id = $post_id";
    $update_result = $conn->query($update_sql);

    if ($update_result) {
        echo "✅ 수정 완료! <a href='view.php?id=$post_id'>글로 돌아가기</a>";
    } else {
        echo "❌ 실패: " . $conn->error;
    }
    exit();
}
?>

<!-- 수정 폼 -->
<h2>✏ 글 수정</h2>
<form method="post">
    제목: <input type="text" name="title" value="<?= htmlspecialchars($row["title"]) ?>"><br><br>
    내용:<br>
    <textarea name="content" rows="5" cols="40"><?= htmlspecialchars($row["content"]) ?></textarea><br><br>
    <input type="submit" value="수정 완료">
</form>
