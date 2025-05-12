<?php
function connectDB() {
    // include __DIR__  외부 파일을 불러오는 함수
    $config = include __DIR__ . '/config.php';  //배열 형태로 전달 

    $conn = new mysqli(
        $config['host'],
        $config['user'],
        $config['pass'],
        $config['dbname']
    );

    if ($conn->connect_error) {
        error_log("DB 연결 실패: " . $conn->connect_error);  // 에러 로그 남기기
    }

    $conn->set_charset("utf8mb4"); // 한글 깨짐 방지

    return $conn;
}

