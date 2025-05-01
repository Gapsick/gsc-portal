<?php 
include "db.php";
$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM board WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2> <?= $row['title'] ?> </h2>
    <p> <?= nl2br($row['content']) ?></p>

    <!-- 삭제 버튼 -->
    <form action="request.php?action=delete" method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit">삭제</button>
    </form>

    <a href="main.php">[목록으로]</a>


</body>
</html>