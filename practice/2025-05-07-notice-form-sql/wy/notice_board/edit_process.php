<?php
session_start();

// DB 연결
$conn = mysqli_connect("210.101.236.159", "root", "gsc1234!@#$", "wy_project_practice_db");

// 1. POST로 전달된 id와 수정된 제목, 내용을 받음
$id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
$title = isset($_POST["title"]) ? $_POST["title"] : '';
$content = isset($_POST["content"]) ? $_POST["content"] : '';

// 2. 글 데이터 가져오기
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "해당 글을 찾을 수 없습니다.";
    exit();
}


// 비교
if ($session_user !== $post_author) {
    echo "권한이 없습니다.";
    exit();
}

// 3. 글 수정 처리 (DB 업데이트)
$sql_update = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("ssi", $title, $content, $id);
$stmt_update->execute();

// 수정이 완료된 후 리다이렉트
header("Location: view.php?id=$id");
exit();
?>
