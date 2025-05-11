<?php
$host = "210.101.236.159";
$user = "root";
$pass = "gsc1234!@#$";
$dbname = "school_portal";

$mysqli = new mysqli($host, $user, $pass, $dbname);

if ($mysqli->connect_error) {
    die("DB 연결 실패: " . $mysqli->connect_error);
}

// 한글 깨짐 방지
$mysqli->set_charset("utf8mb4");
?>
