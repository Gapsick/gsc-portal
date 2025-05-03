<?php
session_start();

// DB 연결
$conn = mysqli_connect("210.101.236.159", "root", "gsc1234!@#$", "wy_project_practice_db");

// 1. POST로 전달된 id 받기
$id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;

// id 값 확인
echo "받은 id = $id<br>";  // id가 정상적으로 전달되는지 확인

// 2. 글 데이터 가져오기
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// 글이 존재하지 않으면 에러 처리
if (!$post) {
    echo "해당 글을 찾을 수 없습니다.";
    exit();
}


// 비교
if ($session_user !== $post_author) {
    echo "권한이 없습니다.";
    exit();
}

// 3. 글 삭제 처리
$sql_delete = "DELETE FROM posts WHERE id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $id);
$stmt_delete->execute();

// 삭제 후 목록 페이지로 리디렉션
header("Location: list.php");
exit();
?>
