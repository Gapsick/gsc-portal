<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

// DB 연결
$conn = mysqli_connect("210.101.236.159", "root", "gsc1234!@#$", "wy_project_practice_db");

// 로그인 정보 수신
$login_id = isset($_POST['login_id']) ? $_POST['login_id'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// 사용자 조회
$sql = "SELECT * FROM users WHERE login_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        // 로그인 성공 → 세션 저장하고 바로 이동
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login_id'] = $user['login_id'];
        $_SESSION['username'] = $user['username'];

        header("Location: welcome.php");
        exit;
    } else {
        // 비밀번호 틀림
        echo "<script>alert('비밀번호가 틀렸습니다.'); history.back();</script>";
        exit;
    }
} else {
    // 아이디 없음
    echo "<script>alert('아이디가 존재하지 않습니다.'); history.back();</script>";
    exit;
}

$stmt->close();
$conn->close();


