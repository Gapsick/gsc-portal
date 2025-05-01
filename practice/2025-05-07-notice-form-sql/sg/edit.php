<?php
session_start(); // 세션 시작 -> 로그인 정보 확인을 위해 반드시 필요
require_once("db.php"); // DB 연결 객체 mysqli 불러오기

// 비로그인 사용자가 직접 URL로 접근하는 경우 차단
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // 로그인 페이지로 리디렉션
    exit;
}

$error = "";   // 에러 메시지 초기화
$success = ""; // 성공 메시지 초기화

// URL로 전달받은 수정할 게시글 ID (ex: edit.php?id=3)
$id = intval($_GET['id'] ?? 0); // 숫자가 아니면 0으로 처리

// 게시글 정보 불러오기 (GET 방식일 때)
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $stmt = $mysqli->prepare("SELECT title, content, user_id FROM notices WHERE id = ?");
    $stmt->bind_param("i", $id); // 게시글 ID 바인딩
    $stmt->execute();
    $stmt->bind_result($title, $content, $writer_id); // 결과 바인딩
    
    // 게시글이 존재할 때
    if ($stmt->fetch()) {
        // 현재 로그인 사용자가 작성자가 아닐 경우 접근 차단
        if ($_SESSION['user']['id'] !== $writer_id) {
            die("권한이 없습니다."); // 보안 처리
        }
    } else {
        die("게시글을 찾을 수 없습니다."); // 없는 게시글이면 종료
    }
    $stmt->close(); // 자원 정리
}

// 수정 내용 처리 (POST 방식일 때)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 사용자가 입력한 값 (공백 제거)
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    // 제목과 내용이 비어 있으면 에러 처리
    if ($title === "" || $content === "") {
        $error = "제목과 내용을 모두 입력해주세요.";
    } else {
        // UPDATE 쿼리 실행 (작성자 일치하는 경우만)
        $stmt = $mysqli->prepare("UPDATE notices SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssii", $title, $content, $id, $_SESSION['user']['id']); // 데이터 바인딩
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $success = "수정 완료!";
            // 수정 후 목록으로 리디렉션 
            header("Location: index.php"); exit;
        } else {
            $error = "수정할 수 없거나 변경사항이 없습니다.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>공지사항 수정</title>
</head>
<body>

<h2>✏️ 공지사항 수정</h2>

<!-- 에러/성공 메시지 출력 -->
<?php if ($error): ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p style="color:green"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<!-- 수정 입력 폼: 기존 값을 value/textarea에 자동 삽입 -->
<form action="edit.php?id=<?= $id ?>" method="post">
    제목: <input type="text" name="title" value="<?= htmlspecialchars($title ?? '') ?>"><br><br>
    내용:<br>
    <textarea name="content" rows="8" cols="50"><?= htmlspecialchars($content ?? '') ?></textarea><br><br>
    <button type="submit">수정하기</button>
</form>

<p><a href="index.php">← 목록으로 돌아가기</a></p>

</body>
</html>
