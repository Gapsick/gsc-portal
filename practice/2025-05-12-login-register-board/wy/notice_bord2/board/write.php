<?php
session_start();
require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/board.php';

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    exit('로그인한 사용자만 글을 작성할 수 있습니다.');
}

// POST 데이터 받기
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$userId = $_SESSION['user_id'];

if ($title === '' || $content === '') {
    exit('제목과 내용을 모두 입력해주세요.');
}

try {
    $conn = connectDB();

    if (createPost($conn, $userId, $title, $content)) {
        echo "<p>글이 성공적으로 등록되었습니다. <a href='list.php'>목록으로 가기</a></p>";
    } else {
        echo "<p>글 저장에 실패했습니다.</p>";
    }

    $conn->close();
} catch (Exception $e) {
    echo "오류 발생: " . $e->getMessage();
}
