<?php
header("Content-Type: text/html; charset=UTF-8");
session_start(); // 사용자 인증 상태 유지를 위한 세션시작
require_once("db.php"); // DB 연결 파일 포함

$success = ""; // 성공 메시지 초기화
$error = ""; // 에러 메시지 초기화


// 폼이 제출되었는지 확인 (POST 방식)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 입력값을 받아오고 공백 제거
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // 둘 다 입력되지 않은 경우 에러
    if ($username === "" || $password === "") {
        $error = "아이디와 비밀번호 모두 입력하세요";
    } else {
        // 사용자명 중복 여부 확인 (username은 UNIQUE여야 함)
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute(); // 실행
        $stmt->store_result(); // 결과를 메모리에 저장 

        if ($stmt->num_rows > 0) {
            $error = "이미 존재하는 사용자명입니다."; // 중복되는 아이디
        } else {
            // 비밀번호는 보안을 위해 has 처리
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // 새로운 사용자 등록
            $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed);
            $stmt->execute();
            
            // 성공 메시지 출력 및 로그인 페이지 링크 제공
            $success = "회원가입 완료! <a href='login.php'>로그인하기</a>";
        }
    }
}
?>
<head>
    <meta charset="UTF-8">
</head>
<h2>회원가입</h2>

<!-- 에러 메세지 출력 (입력 누락, 중복 등) -->
<?php if ($error): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<!-- 성공 메시지 출력 (회원가입 완료) -->
<?php if ($success): ?>
    <p style="color: green"><?= $success ?></p>
<?php endif; ?>

<!-- 사용자 입력 폼 -->
<form action="register.php" method="post">
    사용자명: <input type="text" name="username"><br><br>
    비밀번호: <input type="password" name="password"><br><br>
    <button type="submit">가입하기</button>
</form>

<!-- 로그인 페이지로 이동하는 링크 -->
<p><a href="login.php">->로그인 페이지로 이동</a></p>

