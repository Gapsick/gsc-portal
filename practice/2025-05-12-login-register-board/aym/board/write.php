<?php
session_start();
include_once __DIR__ . '/../db/db_board.php';

$error = '';
$title = '';
$content = '';
$id = $_GET['id'] ?? null;

$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
if (!$isLoggedIn){
    header('Location: ../user/login.php');
    exit;
}

// 수정의 경우 기존 내용 초기화
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id !== null) {
    $notice = getNoticeById($id);
    if ($notice) {
        $title = $notice['title'];
        $content = $notice['content'];
    } else {
        $error = '해당 글을 찾을 수 없습니다.';
    }
}

// 등록
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($id) {
        updateNotice($id, $title, $content);
    } else {
        addNotice($title, $content);
    }

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
</head>
<body>
    <h1><?= $id ? '글 수정' : '새 글 작성' ?></h1>

    <?php if ($error) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>

    <?php else: ?>
        <form method="POST">
            <!-- 수정의 경우 id도 같이 전송 -->
            <?php if ($id): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <?php endif; ?>

            제목: <input name="title" value="<?= htmlspecialchars($title) ?>" placeholder="제목 입력" required><br>
            내용: <textarea name="content" placeholder="내용 입력" required><?= htmlspecialchars($content) ?></textarea><br>
            <button type="submit">등록</button>
        </form>
    <?php endif; ?>
    
    <a href="index.php">취소</a>
</body>
</html>

