<?php
    require_once 'db_connect.php';
    $conn = connectDB();

    $id = $_GET['id'] ?? null;
    $notice = null;

    // 해당 게시글 조회
    if($id != null){
        $notice = getNoticeById($conn, $id);
    }

    // 삭제) POST요청을 받았을 때 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        deleteNotice($conn, $id);
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
        <!-- 내용 출력 (nl2br : 개행 처리)-->
        <p><strong>내용:</strong><br>
            <?= nl2br(htmlspecialchars($notice['content'])) ?>
        </p>
        <!-- 등록일 출력 -->
        <p><strong>등록일:</strong> <?= $notice['created_at'] ?></p>

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

    <?php else: ?>
        <p>해당 글을 찾을 수 없습니다.</p>
    <?php endif; ?>

    <a href="index.php">돌아가기</a>

</body>
</html>