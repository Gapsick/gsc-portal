<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- src/write.html -->
    <h2>글 작성</h2>
    <form method="post" action="request.php?action=insert">
    <input type="text" name="title" placeholder="제목" required><br>
    <textarea name="content" placeholder="내용" required></textarea><br>
    <button type="submit">작성</button>
    </form>

</body>
</html>