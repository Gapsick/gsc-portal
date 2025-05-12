<?php
require_once 'db.php';

// 회원가입 함수
function createUser($userId, $password) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO test_user (userId, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $userId, $hashedPassword);
    return $stmt->execute();
}

// 회원조회 함수
function foundUser($userId, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM test_user WHERE userId = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return null;
}
?>
