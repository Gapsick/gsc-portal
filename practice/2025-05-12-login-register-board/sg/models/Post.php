<?php
require_once __DIR__ . '/../config/config.php';

class Post {
    // 글 작성
    public static function create($user_id, $title, $content) {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO posts (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iss", $user_id, $title, $content);
        return $stmt->execute();
    }

    // 전체 글 목록 조회
    public static function getAll() {
        global $mysqli;
        $result = $mysqli->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 특정 글 조회
    public static function findById($id) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 글 수정 (작성자 확인 포함)
    public static function update($post_id, $user_id, $title, $content) {
        global $mysqli;
        $stmt = $mysqli->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssii", $title, $content, $post_id, $user_id);
        return $stmt->execute();
    }

    // 글 삭제 (작성자 확인 포함)
    public static function delete($post_id, $user_id) {
        global $mysqli;
        $stmt = $mysqli->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $post_id, $user_id);
        return $stmt->execute();
    }
}
