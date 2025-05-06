<?php
session_start();
require_once("db.php");

// 로그인 안 했으면 접근 차단
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// 삭제할 글 ID 가져오기
$id = intval($_GET['id'] ?? 0);

// 게시글 존재 여부 + 작성자 본인 확인
$stmt = $mysqli->prepare("SELECT user_id FROM notices WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($writer_id);

if ($stmt->fetch()) {
    // 로그인한 사용자가 작성자가 아니면 차단
    if ($_SESSION['user']['id'] !== $writer_id) {
        die("삭제 권한이 없습니다.");
    }
} else {
    die("게시글을 찾을 수 없습니다.");
}
$stmt->close();

// 삭제 실행
$stmt = $mysqli->prepare("DELETE FROM notices WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $_SESSION['user']['id']);
$stmt->execute();

// 완료 후 목록으로 리디렉션
header("Location: index.php");
exit;
