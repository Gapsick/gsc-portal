<?php
require_once __DIR__ . '/../config/config.php';

class User {
    // 회원가입: 사용자 추가
    public static function create($username, $password) {
        global $mysqli;

        // 비밀번호 해시 처리
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO users (username, password, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $username, $hashedPassword);
        return $stmt->execute(); // 성공 여부 true/false 반환
    }

    // 로그인: 사용자 조회
    public static function findByUsername($username) {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc(); // 사용자가 없으면 null 반환
    }
}
