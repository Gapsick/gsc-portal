<?php
include "db.php";

// 애러 처리 함수
function execute_stmt($conn, $sql, $types, ...$params) {
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        error_log("쿼리 준비 실패: " . mysqli_error($conn));
        return false;
    }

    if (!mysqli_stmt_bind_param($stmt, $types, ...$params)) {
        error_log("바인딩 실패: " . mysqli_stmt_error($stmt));
        return false;
    }

    if (!mysqli_stmt_execute($stmt)) {
        error_log("실행 실패: " . mysqli_stmt_error($stmt));
        return false;
    }

    return $stmt;
}


// DB 로직
$action = $_GET['action'] ?? '';

switch ($action) {

  // 추가
  case 'insert':
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!$title || !$content) {
        exit("제목과 내용을 모두 입력하세요.");
    }

    $result = execute_stmt($conn, "INSERT INTO board (title, content) VALUES (?, ?)", "ss", $title, $content);
    if (!$result) {
        exit("글 작성에 실패했습니다.");
    }

    echo "<script>alert('글이 작성되었습니다.'); location.href='main.php';</script>";
    exit;

  // 삭제
  case 'delete':
    $id = $_POST['id'] ?? null;
    if (!$id || !is_numeric($id)) {
        exit("올바른 ID가 필요합니다.");
    }

    $result = execute_stmt($conn, "DELETE FROM board WHERE id=?", "i", $id);
    if (!$result) {
        exit("삭제 중 오류가 발생했습니다.");
    }

    echo "<script>alert('삭제되었습니다.'); location.href='main.php';</script>";
    exit;

  // 수정
  case 'update':
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!$id || !$title || !$content) {
        exit("모든 필드를 입력하세요.");
    }

    $result = execute_stmt($conn, "UPDATE board SET title = ?, content = ? WHERE id = ?", "ssi", $title, $content, $id);
    if (!$result) {
        exit("수정 중 문제가 발생했습니다.");
    }

    echo "<script>alert('수정 완료'); location.href='view.php?id=$id';</script>";
    exit;

  default:
    echo "잘못된 요청입니다.";
    exit;
}
?>
