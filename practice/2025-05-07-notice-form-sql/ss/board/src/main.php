<?php
include "db.php";
include "functions.php";

$rows = get_all_boards($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>
<body>
<h1>게시글 목록</h1>

<?php if (empty($rows)): ?>
  <p>게시글이 없습니다.</p>

<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>번호</th>
        <th>제목</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td class="title">
            <a href="view.php?id=<?= $row['id'] ?>">
              <?= htmlspecialchars($row['title']) ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<br>
<a href="write.php"><button>글작성</button></a>
</body>
</html>