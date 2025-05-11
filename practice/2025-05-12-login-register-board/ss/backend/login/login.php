<?php
session_start();
include "../db/db.php";

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, user_id, password FROM users WHERE user_id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['user_id'];
    
    header("Location: ../../frontend/main/main.php");
    exit;
} else {
    echo "아이디 또는 비밀번호가 틀렸습니다.";
}
?>
