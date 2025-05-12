<?php
// DB 연결 파일
$conn = new mysqli("210.101.236.159", "root", "gsc1234!@#$", "lhj_db");

if ($conn->connect_error) {
    die("❌ DB 연결 실패: " . $conn->connect_error);
}
?>
