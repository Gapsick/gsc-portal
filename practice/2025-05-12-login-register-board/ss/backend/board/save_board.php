<?php
include "../db/db.php";
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: ../frontend/login/index.html");
    exit;
}

// POST 데이터 받기
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$author = $_POST['author'] ?? '익명';

// 빈 값 체크
if (!$title || !$content) {
    die("제목과 내용을 모두 입력해주세요.");
}

// DB에 저장
$stmt = $conn->prepare("INSERT INTO board (title, content, author) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $content, $author);
$stmt->execute();

// 저장 후 게시판으로 이동
header("Location: ../../frontend/board/board.php");
exit;
?>
