<?php
include "../db/db.php";
session_start();

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if (!$id || !$title || !$content) {
    die("모든 값을 입력해주세요.");
}

$stmt = $conn->prepare("UPDATE board SET title = ?, content = ? WHERE id = ?");
$stmt->bind_param("ssi", $title, $content, $id);
$stmt->execute();

header("Location: ../../frontend/board/view.php?id=" . $id);
exit;
