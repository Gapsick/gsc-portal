<?php
session_start();
require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/board.php';

$postId = intval($_POST['id'] ?? 0);
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$userId = $_SESSION['user_id'] ?? 0;

if ($postId <= 0 || $title === '' || $content === '') {
    exit('모든 항목을 올바르게 입력해주세요.');
}

$conn = connectDB();
if (updatePost($conn, $postId, $userId, $title, $content)) {
    header("Location: view.php?id=$postId");
    exit;
} else {
    echo "수정에 실패했습니다.";
}
$conn->close();
