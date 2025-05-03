<?php
// 세션 시작
session_start();

// DB 연결
$conn = mysqli_connect("210.101.236.159", "root", "gsc1234!@#$", "wy_project_practice_db");

// 글 ID 가져오기
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

if ($id === 0) {
    header("Location: list.php");
    exit();
}



// 글 불러오기
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "<p>존재하지 않는 글입니다.</p>";
    echo "<a href='list.php'>글 목록으로</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/view.css">
    <title>글 보기</title>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <p><strong>작성자:</strong> <?php echo htmlspecialchars($post['author']); ?></p>
        <p><strong>작성일:</strong> <?php echo $post['created_at']; ?></p>
        <hr>
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <hr>
        <p><a href="list.php">← 목록으로</a></p>

        <?php
    if (isset($_SESSION['username']) && $_SESSION['username'] === $post['author']) {
    ?>
            <a href="edit.php?id=<?php echo $post['id']; ?>">수정</a>
            <form action="delete.php" method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <button type="submit" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</button>
        </form> 
        <?php } ?>
    </div>

</body>
</html>
