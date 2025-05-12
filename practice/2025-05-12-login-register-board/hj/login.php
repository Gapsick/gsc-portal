<?php
session_start();         // 로그인상태 유지 세션 시작
include "db.php";        // DB 연결

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["username"];      // 입력한 아이디
    $pw = $_POST["password"];      // 입력한 비밀번호

    // DB에서 해당 아이디의 사용자 정보 가져오기
    $sql = "SELECT * FROM users WHERE username='$id'";
    $result = $conn->query($sql);

    // 사용자 정보가 있으면
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();     // 한 줄 가져오기
        $hashed_pw = $user["password"];     // DB에 저장된 암호화된 비밀번호

        // 비밀번호 일치 확인
        if (password_verify($pw, $hashed_pw)) {
            $_SESSION["user_id"] = $user["id"];       // 로그인 유지용 세션 저장
            $_SESSION["username"] = $user["username"];

            echo "✅ 로그인 성공!<br>";
            echo "<a href='board.php'>게시판으로 가기</a>";
        } else {
            echo "❌ 비밀번호가 틀렸어요!";
        }
    } else {
        echo "❌ 아이디가 없어요!";
    }
}
?>

<!-- HTML 입력 폼 -->
<h2>로그인</h2>
<form method="post">
    아이디: <input type="text" name="username"><br>
    비밀번호: <input type="password" name="password"><br>
    <input type="submit" value="로그인">
</form>
