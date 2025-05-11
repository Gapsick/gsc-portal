<?php
require_once __DIR__ . '/../models/User.php';

// 회원가입 함수
function register() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // 기본 유효성 검사
        if ($username === '' || $password === '') {
            echo "<script>alert('아이디와 비밀번호를 모두 입력해주세요.'); history.back();</script>";
            return;
        }

        // 중복 아이디 체크
        $existingUser = User::findByUsername($username);
        if ($existingUser) {
            echo "<script>alert('이미 존재하는 아이디입니다.'); history.back();</script>";
            return;
        }

        // 회원가입 처리
        $result = User::create($username, $password);
        if ($result) {
            echo "<script>alert('회원가입이 완료되었습니다.'); location.href='index.php?action=loginForm';</script>";
        } else {
            echo "<script>alert('회원가입에 실패했습니다.'); history.back();</script>";
        }
    }
}

// 로그인 함수
function login() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // 빈 값 체크
        if ($username === '' || $password === '') {
            echo "<script>alert('아이디와 비밀번호를 모두 입력해주세요.'); history.back();</script>";
            return;
        }

        // 사용자 조회
        $user = User::findByUsername($username);
        if (!$user) {
            echo "<script>alert('존재하지 않는 아이디입니다.'); history.back();</script>";
            return;
        }

        // 비밀번호 일치 확인
        if (!password_verify($password, $user['password'])) {
            echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
            return;
        }

        // 로그인 성공 → 세션에 사용자 ID 저장
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo "<script>alert('로그인 성공!'); location.href='index.php?action=list';</script>";
    }
}
?>