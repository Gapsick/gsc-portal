<?php
require_once 'db.php';

// 모든 정보 조회
function getAllNotices() {
    global $conn;
    return $conn->query("SELECT * FROM test_notices ORDER BY id DESC");
}

// 특정 정보 조회 (id)
function getNoticeById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM test_notices WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// 추가 (제목, 내용)
function addNotice($title, $content) {
    global $conn;
    $userId = $_SESSION['userId'] ?? '';
    $stmt = $conn->prepare("INSERT INTO test_notices (title, content, userId) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $userId);
    return $stmt->execute();
}

// 수정 (id, 제목, 내용)
function updateNotice($id, $title, $content) {
    global $conn;
    $stmt = $conn->prepare("UPDATE test_notices SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    return $stmt->execute();
}

// 삭제 (id)
function deleteNotice($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM test_notices WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

?>