<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>
<body>
<h1>게시글 목록</h1>    

<?php 
$result = mysqli_query($conn, "SELECT * FROM board ORDER BY id DESC");    
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>
        <a href='view.php?id={$row['id']}'> 
        {$row['title']} 
        </a>
    </p>";
}
?>

<a href="write.php"> 글 작성 </a>



</body>
</html>