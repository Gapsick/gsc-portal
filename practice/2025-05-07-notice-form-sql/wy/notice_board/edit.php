<?php
session_start();

$conn = mysqli_connect("210.101.236.159", "root", "gsc1234!@#$", "wy_project_practice_db");

// 1. GET으로 id를 받음
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// 2. 글 불러오기
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// 3. 권한 체크
if (!$post || $_SESSION["username"] !== $post["author"]) {
    echo "권한이 없습니다";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/write.css">
    <title>글 수정</title>
</head>
<body>
    <div class="container">
        <h1>글 수정하기</h1>

        <form action="edit_process.php" method="post">
            
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">

            <div>
                <label for="title">제목</label><br>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>">
            </div>

            <div>
                <label for="content">내용</label><br>
                <textarea id="content" name="content" rows="10" cols="50"><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>

            <button type="submit">수정완료</button>
        </form>
    </div>


</body>
</html>
