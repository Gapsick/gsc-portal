<?php
include "db.php";
$action = $_GET['action'] ?? '';

switch ($action) {
  case 'insert':
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = mysqli_prepare($conn, "INSERT INTO board (title, content) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $title, $content);
    mysqli_stmt_execute($stmt);
    header("Location: main.php");
    break;

  case 'delete':
    $id = $_POST['id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM board WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: main.php");
    break;

  case 'update':
    // 나중에 수정 기능 추가할 때 사용
    break;

  default:
    echo "잘못된 요청입니다.";
}
