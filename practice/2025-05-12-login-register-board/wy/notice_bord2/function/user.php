<?php

//유저 이름 중복확인을 위한 함수
function isUsernameTaken(mysqli $conn, string $username): bool {
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    $exists = $stmt->num_rows > 0;
    $stmt->close();

    return $exists;
}


//회원가입 정보 넣는 함수 
function registerUser(mysqli $conn, string $username, string $password): bool {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

//로그인 체크 함수
function checkLogin(mysqli $conn, string $username, string $password): ?int {
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $stmt->close();
        return $userId;  // 로그인 성공: 사용자 ID 반환
    }

    $stmt->close();
    return null;  // 로그인 실패
}








// // ✅ 핵심 결론
// 왜 ($conn 함수 안불러옴 
// 이 함수들은 DB 연결을 직접 만드는 책임이 없고,
// 연결된 객체($conn)를 전달받아 사용하는 구조이기 때문이야!
