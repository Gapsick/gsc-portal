<?php
session_start();
include 'db.php';

// 로그인 확인
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

// 글 ID 받기
if (!isset($_GET["id"])) {
    echo "잘못된 접근입니다.";
    exit();
}

$post_id = $_GET["id"];
$user_id = $_SESSION["user_id"];

// 글 작성자 확인
$stmt = $conn->prepare("SELECT user_id FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($author_id);
$stmt->fetch();
$stmt->close();

// 글이 존재하지 않거나 다른 사람의 글일 경우
if (!$author_id) {
    echo "글을 찾을 수 없습니다.";
    exit();
}
if ($author_id != $user_id) {
    echo "자신이 작성한 글만 삭제할 수 있습니다.";
    exit();
}

// 삭제 실행
$delete = $conn->prepare("DELETE FROM posts WHERE id = ?");
$delete->bind_param("i", $post_id);

if ($delete->execute()) {
    header("Location: board.php");
    exit();
} else {
    echo "삭제 실패: " . $delete->error;
}
?>
