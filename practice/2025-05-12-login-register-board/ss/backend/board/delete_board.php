<?php
include "../db/db.php";
session_start();

$id = $_POST['id'] ?? null;
if (!$id) die("유효하지 않은 요청입니다.");

// (선택) 본인 글만 삭제하게 하려면 글 작성자 체크 로직 추가

$stmt = $conn->prepare("DELETE FROM board WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../../frontend/board/board.php");
exit;
