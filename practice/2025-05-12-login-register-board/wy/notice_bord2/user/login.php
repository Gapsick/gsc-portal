<?php
session_start();
require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/user.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('잘못된 접근 방식입니다.');
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    exit('이름과 비밀번호를 모두 입력하세요.');
}

try {
    $conn = connectDB();
    $userId = checkLogin($conn, $username, $password);

    if ($userId !== null) {
        $_SESSION['user_id'] = $userId;
        echo "로그인 성공! <a href='../board/list.php'>게시판으로 이동</a>";
    } else {
        echo "로그인 실패: 사용자명 또는 비밀번호가 일치하지 않습니다.";
    }

    $conn->close();
} catch (Exception $e) {
    echo "오류 발생: " . $e->getMessage();
} 