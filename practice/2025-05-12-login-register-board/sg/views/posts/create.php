<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글쓰기</title>
</head>
<body>
    <h2>글 작성</h2>

    <form action="index.php?action=create" method="post">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="10" cols="50" required></textarea><br><br>

        <button type="submit">등록</button>
        <a href="index.php?action=list">목록으로</a>
    </form>
</body>
</html>
