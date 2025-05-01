<?php
$mysqli = new mysqli("localhost", "root", "root123", "school_portal");

$mysqli->set_charset("utf8mb4");

if ($mysqli->connect_error) {
    die("DB 연결 실패: " . $mysqli->connect_error);
}
?>