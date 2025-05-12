<?php
require_once __DIR__ . '/../db/connect.php';
require_once __DIR__ . '/../function/user.php';


// 1. POST 방식이 아닐 경우 종료
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('잘못된 접근 방식입니다.');
}

// 2. 사용자 입력값 받기
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// 3. 입력값 비었는지 체크
if ($username === '' || $password === '') {
    exit('이름과 비밀번호를 모두 입력하세요.');
}

try {
    // 4. DB 연결
    $conn = connectDB();

    // 5. 사용자명 중복 확인
    if (isUsernameTaken($conn, $username)) {
        exit('이미 존재하는 사용자명입니다.');
    }

    
    if (registerUser($conn, $username, $password)) {
        // 회원가입 성공 → 로그인 페이지로 자동 이동
        header("Location: login_form.html");
        exit();
    } else {
        // 실패 → 에러 메시지 출력
        echo "회원가입 실패: DB 저장 중 오류가 발생했습니다.";
    }

    // 7. DB 연결 종료
    $conn->close();
} catch (Exception $e) {
    echo "오류 발생: " . $e->getMessage();
}
