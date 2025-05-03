<?php
session_start();

$conn = mysqli_connect("210.101.236.159","root","gsc1234!@#$","wy_project_practice_db");



// 글 목록 불러오기
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/list.css">
    <title>게시판</title>
</head>
<body>
    <h1>게시판 목록</h1>

    <?php if (isset($_SESSION['login_id'])): ?>
        <p>안녕하세요, <?php echo htmlspecialchars($_SESSION['username']); ?>님 </p>
        <a class="write" href="write.php"> 글쓰기</a> |
        <a class="logout" href="logout.php">로그아웃</a>
    <?php else: ?>
        <a href="login.php">로그인</a>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($row['author']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
