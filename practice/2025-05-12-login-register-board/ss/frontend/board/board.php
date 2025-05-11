<?php 
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.html");
    exit;
}
include "../../backend/db/db.php";



// 게시글 목록 가져오기
$result = $conn->query("SELECT * FROM board ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>
<body>
    <h2>공지사항</h2>
    <table border="1">
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성자</th>
            <th>작성일</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><a href="view.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></a></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
        
    <br>
     <button onclick="location.href='write.php'">글쓰기</button>
    <br>
     <button onclick="location.href='../main/main.php'">메인으로</button>

</body>
</html>