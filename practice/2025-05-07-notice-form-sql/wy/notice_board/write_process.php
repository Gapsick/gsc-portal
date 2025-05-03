<?php
session_start();

// 로그인한 사람만 접근 가능
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// DB 연결
$conn = mysqli_connect("210.101.236.159", "root", "gsc1234!@#$", "wy_project_practice_db");

// 글 내용 받기
$title = $_POST['title'];
$content = $_POST['content'];
$author = $_SESSION['username'];

// 보안 처리
$sql = "INSERT INTO posts (title, content, author) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $content, $author);

// 결과에 따라 HTML 출력
$success = $stmt->execute();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글 등록 결과</title>
    <link rel="stylesheet" href="css/write.css">
    <style>
        .result-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }

        .result-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <?php if ($success): ?>
            <h2>글이 성공적으로 등록되었습니다!</h2>
            <a href="list.php" class="btn">목록으로 이동</a>
        <?php else: ?>
            <h2>글 등록 중 오류가 발생했습니다.</h2>
            <p>다시 시도해주세요.</p>
            <a href="write.php" class="btn">다시 작성하기</a>
        <?php endif; ?>
    </div>
</body>
</html>

