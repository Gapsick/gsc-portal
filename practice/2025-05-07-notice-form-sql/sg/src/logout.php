<?php
session_start(); // 세션 시작 (사용 중이어야 파괴 가능)
session_unset(); // 모든 세션 변수 제거
session_destroy(); // 세션 자체를 파괴

// 로그인 페이지로 이동
header("Location: login.php");
exit;
?>