<?php
// $mode = 'create' or 'edit'
// $post = ['id' => ..., 'title' => ..., 'content' => ...] (edit 시에만 존재)
$isEdit = ($mode === 'edit');
$action = $isEdit ? 'edit' : 'create';
$pageTitle = $isEdit ? '글 수정' : '글 작성';
$submitLabel = $isEdit ? '수정하기' : '등록하기';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
</head>
<body>
    <h2><?= $pageTitle ?></h2>

    <form action="index.php?action=<?= $action ?>" method="post">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <?php endif; ?>

        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title"
               value="<?= $isEdit ? htmlspecialchars($post['title']) : '' ?>" required><br><br>

        <label for="content">내용:</label><br>
        <textarea id="content" name="content" rows="10" cols="50" required><?= $isEdit ? htmlspecialchars($post['content']) : '' ?></textarea><br><br>

        <button type="submit"><?= $submitLabel ?></button>
        <a href="index.php?action=list">목록으로</a>
    </form>
</body>
</html>
