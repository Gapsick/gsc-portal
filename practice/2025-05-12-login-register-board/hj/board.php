<?php
session_start();          // 세션으로 로그인 정보 확인
include "db.php";         // DB 연결

// 로그인 확인
if (!isset($_SESSION["user_id"])) {
    echo "로그인 후 이용 가능합니다. <a href='login.php'>로그인하기</a>";
    exit();
}

// 글 목록 불러오기 (작성자 이름도 같이)
$sql = "SELECT posts.id, posts.title, posts.created_at, users.username
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.id DESC";

$result = $conn->query($sql);
?>

<h2>📋 게시판</h2>
<p>안녕하세요, <?= $_SESSION["username"] ?>님! |
   <a href="write.php">✏ 글쓰기</a> |
   <a href="logout.php">🔓 로그아웃</a>
</p>

<table border="1" cellpadding="10">
    <tr>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>작성일</th>
    </tr>

    <?php
    if ($result->num_rows > 0) { // DB에서받아온 글 유무확인
        while ($row = $result->fetch_assoc()) { // SELECT 결과에 글이 한개이상일시 반복문 실행
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td><a href='view.php?id={$row['id']}'>" . htmlspecialchars($row["title"]) . "</a>";

            // 작성자 본인인 경우만 수정 링크 보이기
            if ($row["username"] === $_SESSION["username"]) {
                echo " | <a href='edit.php?id={$row['id']}'>수정</a>";
            }

            echo "</td>"; // 글 작성자 이름 출력
            echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "</tr>"; 
        }
    } else {
        echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
    }
    ?>
</table>
