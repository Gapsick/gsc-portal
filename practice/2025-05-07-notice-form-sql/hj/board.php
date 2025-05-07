<?php
session_start();
include 'db.php';

// 로그인 여부 확인
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

// 게시글 불러오기
$sql = "SELECT posts.id, posts.title, posts.created_at, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>📋 게시판</h2>
<p>
    안녕하세요, <?= htmlspecialchars($_SESSION["username"]) ?>님!
    | <a href="logout.php">🔓 로그아웃</a>
</p>
<a href="write.php">✍ 글쓰기</a>

<hr>

<table border="1" cellpadding="10">
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><a href='view.php?id=" . $row["id"] . "'>" . htmlspecialchars($row["title"]) . "</a></td>";

        // 현재 로그인한 사용자가 글 작성자일 경우에만 '수정' 링크 추가
        if ($row["username"] === $_SESSION["username"]) {
            echo " | <a href='edit.php?id=" . $row["id"] . "'>수정</a>";
        }

        echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
}
$conn->close();
?>
</table>

</body>
</html>