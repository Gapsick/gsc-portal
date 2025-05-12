<?php

$host = '210.101.236.159';
$user = 'root';
$pass = 'gsc1234!@#$';
$dbname = 'me_database';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('DB 연결 실패: ' . $conn->connect_error);
}

?>
