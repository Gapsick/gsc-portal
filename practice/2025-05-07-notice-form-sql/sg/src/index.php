<?php
session_start(); // 세션 시작 -> 로그인 여부 확인 가능
require_once("db.php"); // DB 연결

// 공지사항 전체 조회 (최신순)
$sql = "SELECT n.id, n.title, n.content, n.created_at, u.username 
        FROM notices n
        JOIN users u ON n.user_id = u.id
        ORDER BY n.created_at DESC";
$result = $mysqli->query($sql); // 쿼리 실행 -> 결과를 $result로 저장
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>공지사항 목록</title>
</head>
<body>

<h2>📢 공지사항 게시판</h2>

<!-- 로그인 여부에 따라 UI 다르게 표시 -->
<?php if (isset($_SESSION['user'])): ?>
    <!-- 로그인 되어 있을 경우: 사용자 이름 표시 + 글쓰기 로그아웃 버튼 -->
  <p>안녕하세요, <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>님!</p>
  <a href="create.php">글쓰기</a> |
  <a href="logout.php">로그아웃</a>
<?php else: ?>
    <!-- 로그인 안 된 경우: 로그인/회원가입 유도 -->
  <p>로그인해주세요. <a href="login.php">로그인</a> / <a href="register.php">회원가입</a></p>
<?php endif; ?>

<hr>

<!-- 공지사항 목록 출력 -->
<?php while ($row = $result->fetch_assoc()): ?>
  <!-- 제목 출력 (XSS 방지를 위해 htmlspecialchars) -->
  <h3><?= htmlspecialchars($row['title']) ?></h3>

  <!-- 본문 내용 출력 (줄바꿈 유지 위해 nl2br 사용) -->
  <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>

  <!-- 작성자 및 작성일 정보 출력 -->
  <p><small>작성자: <?= htmlspecialchars($row['username']) ?> / 작성일: <?= $row['created_at'] ?></small></p>

  <!-- 로그인한 사용자 본인이 작성한 글만 수정/삭제 가능 -->
  <?php if (isset($_SESSION['user']) && $_SESSION['user']['username'] === $row['username']): ?>
    <a href="edit.php?id=<?= $row['id'] ?>">수정</a> |
    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a>
  <?php endif; ?>

  <hr> <!-- 각 게시글 구분선 -->
<?php endwhile; ?>

</body>
</html>
