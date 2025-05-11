<?php
$host ="210.101.236.159";
$user ="ss";
$pass ="1234";
$dbname ="ss_test";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}
?>
