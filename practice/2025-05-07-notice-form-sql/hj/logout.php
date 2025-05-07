<?php
session_start();
session_unset(); // 세션 변수 제거
session_destroy(); // 세션 완전 삭제

echo "로그아웃 되었습니다. <a href='login.php'>다시 로그인하기</a>";
?>
