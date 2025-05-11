<?php
include "../db/db.php"; // DB 연결

// POST 데이터 받기
$user_id = $_POST['user_id'] ?? '';
$password = $_POST['password'] ?? '';
$check_password = $_POST['check_password'] ?? '';

// 입력값 확인
if (!$user_id || !$password || !$check_password) {
    echo "<script>
        alert('모든 값을 입력해주세요.');
        history.back();
    </script>";
    exit;
}

// 비밀번호 확인
if ($password !== $check_password) {
    echo "<script>
        alert('비밀번호가 일치하지 않습니다.');
        history.back();
    </script>";
    exit;
}

// 아이디 중복 검사
$stmt = $conn->prepare("SELECT id FROM users WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
        alert('이미 존재하는 아이디입니다.');
        history.back();
    </script>";
    exit;
}

// 비밀번호 해시 후 저장
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$insert = $conn->prepare("INSERT INTO users (user_id, password) VALUES (?, ?)");
$insert->bind_param("ss", $user_id, $hashed_password);

if ($insert->execute()) {
    echo "<script>
        alert('회원가입이 완료되었습니다!');
        window.location.href = '../../frontend/login/login.html';
    </script>";
    exit;
} else {
    echo "<script>
        alert('회원가입에 실패했습니다. 다시 시도해주세요.');
        history.back();
    </script>";
    exit;
}
?>
