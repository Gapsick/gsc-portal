<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
</head>
<body>
    <h2>로그인</h2>
    <form action="index.php?action=login" method="post">
        <label for="username">아이디:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">비밀번호:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">로그인</button>
    </form>

    <p>계정이 없으신가요? <a href="index.php?action=registerForm">회원가입하기</a></p>
</body>
</html>
