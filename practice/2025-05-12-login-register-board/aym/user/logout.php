<?php
session_start();
session_unset();
session_destroy();

// 로그아웃 후 로그인 페이지로 이동
header("Location: login.php");
exit;
?>
