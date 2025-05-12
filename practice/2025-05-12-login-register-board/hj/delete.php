<?php
session_start();
include "db.php";

// 로그인 안 했으면 차단
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용하세요. <a href='login.php'>로그인</a>";
    exit();
}

// 글 번호 받아오기
if (!isset($_GET["id"])) {
    echo "잘못된 접근입니다.";
    exit();
}
$post_id = $_GET["id"];

// 해당 글 가져오기
$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows !== 1) {
    echo "글이 존재하지 않습니다.";
    exit();
}

$row = $result->fetch_assoc();

// 로그인한 사용자가 글 작성자가 아니면 차단
if ($row["user_id"] != $_SESSION["user_id"]) {
    echo "자신의 글만 삭제할 수 있습니다.";
    exit();
}

// 삭제 실행
$delete_sql = "DELETE FROM posts WHERE id = $post_id";
$delete_result = $conn->query($delete_sql);

if ($delete_result) {
    echo "🗑 글이 삭제되었습니다. <a href='board.php'>게시판으로 이동</a>";
} else {
    echo "❌ 삭제 실패: " . $conn->error;
}
?>
