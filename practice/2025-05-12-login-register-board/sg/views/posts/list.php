<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시글 목록</title>
</head>
<body>
    <h2>게시글 목록</h2>

    <?php if (isset($_SESSION['user_id'])): ?>
    <p>
        <a href="index.php?action=createForm">➕ 글쓰기</a> |
        <a href="index.php?action=logout">🚪 로그아웃</a>
        <span style="float:right;">👤 사용자: <?= htmlspecialchars($_SESSION['username']) ?></span>
    </p>
    <?php else: ?>
        <p>
            <a href="index.php?action=loginForm">🔐 로그인</a> |
            <a href="index.php?action=registerForm">📝 회원가입</a>
        </p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= htmlspecialchars($post['id']) ?></td>
                    <td>
                        <a href="index.php?action=view&id=<?= $post['id'] ?>">
                            <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($post['username']) ?></td>
                    <td><?= $post['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
