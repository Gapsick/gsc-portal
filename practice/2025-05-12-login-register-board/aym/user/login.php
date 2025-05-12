<?php
session_start();
include_once __DIR__ . '/../db/db_user.php';

$isRegister = isset($_GET['isRegister']) ? $_GET['isRegister'] === 'true' : false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = trim($_POST['userId'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($isRegister) {
        // 회원정보 추가
        if (createUser($userId, $password)) {
            echo "회원가입 성공!  로그인하세요!";
        } else {
            echo "회원가입 실패";
        };
    } else {
        // 회원정보 조회
        $user = foundUser($userId, $password);
        if ($user) {
            // 세션 등록
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['isLoggedIn'] = true;
            header('Location: ../board/index.php');
            exit;
        } else {
            echo "로그인 실패";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isRegister ? 'Register' : 'Login' ?></title>
</head>
<body>
    <h1><?= $isRegister ? '회원가입' : '로그인' ?></h1>
    <!-- 입력 폼 -->
    <form method="POST">
        <input type="hidden" name="isRegister" id="formStatus" 
            value="<?= $isRegister ? 'true' : 'false'; ?>"
        >

        <label for="userId">ID:</label>
        <input type="text" id="userId" name="userId" placeholder="Your id" required > <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Your password" required><br>
        <button type="submit">SIGN IN</button>
    </form>
<br>
    <!-- 회원가입/로그인 변환 -->
    <form method="GET" id="toggleForm">
        <input type="hidden" name="isRegister" id="toggleStatus" 
            value="<?= $isRegister ? 'true' : 'false'; ?>"
        >
        <button type="submit" onclick="toggleForm(event)">
            <?= $isRegister ? "로그인하기" : "회원가입하기"; ?>
        </button>
    </form>


<script>
function toggleForm(event) {
    event.preventDefault();
    // 현재 상태 가져오기
    const isRegister = document.getElementById("toggleStatus").value === 'true';

    const newStatus = !isRegister;
    window.location.replace(`?isRegister=${newStatus}`);
}
</script>
    
</body>
</html>