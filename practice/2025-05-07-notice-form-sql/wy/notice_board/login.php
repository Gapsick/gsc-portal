<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>정우영 게시판 로그인</title>
</head>
<body>
    <h1>로그인</h1>
    <form action="login_process.php" method="post">
        <div>
            <label for="login_id">아이디 :</label>
            <input type="text" id="login_id" name="login_id" required>
        </div>
        
        <div>
            <label for="password">비밀번호 :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">로그인</button>
    </form>
</body>
</html>
