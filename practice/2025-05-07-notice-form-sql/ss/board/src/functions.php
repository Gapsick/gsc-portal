<?php 

// db 연결
function execute_stmt($conn, $sql, $types, ...$params) {
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        error_log("쿼리 준비 실패: " . mysqli_error($conn));
        return false;
    }

    if (!mysqli_stmt_bind_param($stmt, $types, ...$params)) {
        error_log("바인딩 실패: " . mysqli_stmt_error($stmt));
        return false;
    }

    if (!mysqli_stmt_execute($stmt)) {
        error_log("실행 실패: " . mysqli_stmt_error($stmt));
        return false;
    }

    return $stmt;
}

// 특정 id 값 1개 들고오기
function get_board_by_id($conn, $id) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM board WHERE id = ?");
    if (!$stmt) return false;

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

// 게시글 전체 목록 들고오기
function get_all_boards($conn) {
    $result = mysqli_query($conn, "SELECT * FROM board ORDER BY id DESC");
    if (!$result) {
        error_log("목록 조회 실패: " . mysqli_error($conn));
        return [];
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>