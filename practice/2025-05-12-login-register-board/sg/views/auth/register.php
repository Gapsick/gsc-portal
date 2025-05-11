<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
</head>
<body>
    <h2>회원가입</h2>
    <form action="index.php?action=register" method="post">
        <label for="username">아이디:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">비밀번호:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">회원가입</button>
    </form>

    <p>이미 계정이 있으신가요? <a href="index.php?action=loginForm">로그인하기</a></p>
</body>
</html>
