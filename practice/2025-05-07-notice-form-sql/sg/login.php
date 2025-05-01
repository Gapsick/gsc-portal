<?php
header("Content-Type: text/html; charset=UTF-8"); // HTML 문서 인코딩을 UTF-8로 명시 (한글 깨짐 방지)
session_start(); // 세션 시작 -> 로그인 정보 유지 가능
require_once("db.php"); // DB 연결 저보 불러오기

$error = ""; // 에러 메시지 변수 초기화

// 폼이 전송되었을 경우만 실행ㄹ (POST 방식으로 submit될 때)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 사용자 입력값을 받아오고 앞뒤 공백 제거
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // 입력값이 비었는지 확인
    if ($username === "" || $password === "") {
        $error = "아이디와 비밀번호를 모두 입력해주세요.";
    } else {
        // DB에서 해당 username을 가진 사용자의 id, 비밀번호 해시값 가져오기
        $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username); // 사용자명 바인딩 (보안 위해 prepared statement 사용)
        $stmt->execute(); // 쿼리 실행
        $stmt->bind_result($user_id, $hashed_pw); // 결과를 변수에 바인딩 (fetch하면 변수에 값 자동 대입)
        
        // 결과가 있고, 입력한 비밀번호가 해시값과 일치하면
        if ($stmt->fetch() && password_verify($password, $hashed_pw)) {
            // 로그인 성공 → 세션에 정보 저장
            $_SESSION['user'] = [
                'id' => $user_id,
                'username' => $username
            ];
            // 로그인 후 index.php로 리디렉션
            header("Location: index.php");
            exit;
        } else {
            // 비밀번호 다르거나 사용자 없음
            $error = "아이디 또는 비밀번호가 올바르지 않습니다.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8"> 
    <title>로그인</title>
</head>
<body>
<h2>로그인</h2>

<!-- 에러메시지 출력: 로그인 실패 등-->
<?php if ($error): ?>
  <p style="color: red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<!-- 로그인 폼 (POST 방식) -->
<form action="login.php" method="post">
  사용자명: <input type="text" name="username"><br><br>
  비밀번호: <input type="password" name="password"><br><br>
  <button type="submit">로그인</button>
</form>

<!-- 회원가입 페이지 링크 -->
<p><a href="register.php">→ 회원가입 페이지로 이동</a></p>
</body>
</html>
