<?php
session_start(); // 세션 시작 -> 로그인 여부 확인 및 사용자 정보 유지
require_once("db.php"); // DB 연결 설정 포함 (Mysqli 객체 $mysqli 생성)

// 로그인하지 않은 경우 글쓰게 페이지 접근을 차단, 로그인 페이지로 이동
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // 리디렉션
    exit; // 이후 코드 실행 방지
} 

$error = ""; // 에러 메세지 저장용
$success = ""; // 성공 메세지 저장용

// 폼이 제출된 경우만 실행 (POST 방식인지 확인)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 입력값 받아오기 + 공백 제거
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    // 입력값이 비어있다면 에러 메시지 표시
    if ($title === "" || $content === "") {
        $error = "제목과 내용을 모두 입력하세요.";
    } else {
        // 공지사항 DB에 등록
        $stmt = $mysqli->prepare("INSERT INTO notices (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $_SESSION['user']['id'], $title, $content);
        $stmt->execute();

        $success = "공지사항이 등록되었습니다.";
        header("Location: index.php"); exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>공지사항 작성</title>
</head>
<body>

<h2>공지사항 작성</h2>

<!-- 에러 메시지가 있을 경우 붉은 글씨로 출력 -->
<?php if ($error): ?>
    <p style="color: red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<!-- 성공 메시지가 있을 경우 초록색으로 출력 -->
<?php if ($success): ?>
    <p style="color: green"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<!-- 글쓰기 폼 (POST 방식 전송) -->
<form action="create.php" method="post">
    제목: <input type="text" name="title"><br><br>
    내용:<br>
    <textarea name="content" rows="8" cols="50"></textarea><br><br>
    <button type="submit">등록</button>
</form>

<p><a href="index.php">← 목록으로 돌아가기</a></p>
</body>
</html>
