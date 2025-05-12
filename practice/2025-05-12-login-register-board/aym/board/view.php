<?php
session_start();
include_once __DIR__ . '/../db/db_board.php';

$id = $_GET['id'] ?? null;
$notice = null;

$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
if ($isLoggedIn){
    $userId = $_SESSION['userId'] ?? 'error';
}else{
    header('Location: ../user/login.php');
    exit;
}

// 해당 게시글 조회
if($id != null){
    $notice = getNoticeById($id);
}

// 삭제) POST요청을 받았을 때 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    deleteNotice($id);
    header('Location: index.php');
    exit;
}

?>

<!-- 개별 게시글 출력 -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글</title>
</head>
<body>
    <h1>공지</h1>

    <?php if ($notice): ?>
        <!-- 제목 출력 -->
        <h2><strong>제목:</strong><br>
            <?= htmlspecialchars($notice['title']) ?>
        </h2>

        <p><strong>작성자:</strong> <?= htmlspecialchars($notice['userId']) ?></p>

        <!-- 내용 출력 (nl2br : 개행 처리)-->
        <p><strong>내용:</strong><br>
            <?= nl2br(htmlspecialchars($notice['content'])) ?>
        </p>
        <!-- 등록일 출력 -->
        <p><strong>등록일:</strong> <?= $notice['created_at'] ?></p>
        <?php if ($userId === $notice['userId']): ?>
            <!-- 삭제 (onsubmit로 확인) -->
            <form method="POST" onsubmit="return confirm('정말 삭제하시겠습니까?');">
                <input type="hidden" name="delete" value="1">
                <button type="submit">삭제</button>
            </form>

            <!-- 수정 -->
            <form method="GET" action="write.php">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <button type="submit">수정</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <p>해당 글을 찾을 수 없습니다.</p>
    <?php endif; ?>

    <a href="index.php">돌아가기</a>

</body>
</html>