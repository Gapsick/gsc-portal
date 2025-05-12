<?php
session_start();
require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/board.php';

$postId = intval($_POST['id'] ?? 0);
$userId = $_SESSION['user_id'] ?? 0;

if ($postId <= 0 || $userId <= 0) {
    exit('잘못된 요청입니다.');
}

$conn = connectDB();
if (deletePost($conn, $postId, $userId)) {
    header("Location: list.php");
    exit;
} else {
    echo "삭제에 실패했거나 권한이 없습니다.";
}
$conn->close();
