<?php
$host = getenv("DB_HOST") ?: "210.101.236.159";
$user = getenv("DB_USER") ?: "ss";
$pass = getenv("DB_PASS") ?: "1234";
$dbname = getenv("DB_NAME") ?: "ss_test";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}
?>
