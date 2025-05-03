<?php
$conn = mysqli_connect("210.101.236.159","root","gsc1234!@#$","wy_project_practice_db");

$login_id = $_POST['login_id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$username = $_POST['username'];

$sql = "INSERT INTO users (login_id , password , username)
        VALUES ('$login_id' ,'$password','$username')";

if ($conn->query($sql)) {
    echo "회원 가입 성공! <a href='login.php'>로그인 하러가기</a>";
} else {
    echo "오류 발생: " . $conn->error;
}
?>
