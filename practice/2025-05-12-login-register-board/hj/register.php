<?php
include "db.php"; // DB 연결

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["username"];      // 사용자 아이디
    $pw = $_POST["password"];      // 사용자 비밀번호

    $pw_hashed = password_hash($pw, PASSWORD_DEFAULT); // 비밀번호 암호화

    $sql = "INSERT INTO users (username, password) VALUES ('$id', '$pw_hashed')";
    $result = $conn->query($sql);  // DB에 저장

    if ($result) {
        // 성공 시 로그인 페이지로 이동
        header("Location: login.php");
        exit();
    } else {
        echo "❌ 실패: " . $conn->error;
    }
}
?>

<!-- HTML 입력 폼 -->
<h2>회원가입</h2>
<form method="post">
    아이디: <input type="text" name="username"><br>
    비밀번호: <input type="password" name="password"><br>
    <input type="submit" value="가입하기">
</form>
