<?php
session_start();        // 세션 시작 (있던 세션도 이어받음)
session_unset();        // 모든 세션 변수 제거
session_destroy();      // 세션 자체를 파괴

header("Location: login_form.html");  // 로그인 페이지로 이동
exit();
