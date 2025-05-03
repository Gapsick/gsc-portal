<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>정우영 게시판 회원가입</title>
</head>
<body>
    <h1>회원가입</h1>
    <form action="register_process.php" method="post">
        <div>
            <label for="login_id">아이디 :</label>
            <input type="text" id="login_id" name="login_id" required><br>
        </div>

        <div>
            <label for="password">비밀번호 :</label>
            <input type="password" id="password" name="password" required><br>
        </div>

        <div>
            <label for="username">이름 :</label>
            <input type="text" id="username" name="username" required><br>
        </div>

        <button type="submit">가입하기</button>
    </form>
</body>
</html>
