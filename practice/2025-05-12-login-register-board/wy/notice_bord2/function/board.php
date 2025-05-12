<?php
//테이블 조인 
function getPostList(mysqli $conn): mysqli_result {
    $sql = "SELECT posts.id, posts.title, posts.created_at, users.username 
            FROM posts 
            JOIN users ON posts.user_id = users.id 
            ORDER BY posts.created_at DESC";
    return $conn->query($sql);
}


// 글 저장 
function createPost(mysqli $conn, int $userId, string $title, string $content): bool {
    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userId, $title, $content);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// 상세 글
function getPostById(mysqli $conn, int $id): ?array {
    $stmt = $conn->prepare("
        SELECT posts.id, posts.user_id, posts.title, posts.content, posts.created_at, users.username
        FROM posts
        JOIN users ON posts.user_id = users.id
        WHERE posts.id = ?
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();
    return $post ?: null;
}


//수정
function updatePost(mysqli $conn, int $postId, int $userId, string $title, string $content): bool {
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssii", $title, $content, $postId, $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


//삭제
function deletePost(mysqli $conn, int $postId, int $userId): bool {
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $postId, $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

