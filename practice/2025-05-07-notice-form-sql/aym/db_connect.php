<?php
// db 연결
function connectDB() {
    $host = '210.101.236.159';
    $user = 'root';
    $pass = 'gsc1234!@#$';
    $dbname = 'me_database';

    $conn = new mysqli($host, $user, $pass, $dbname);
    
    if ($conn->connect_error) {
        die('DB 연결 실패: ' . $conn->connect_error);
    }

    return $conn;
}

/*  명령어 정리
    query()       : 직접 SQL 문자열을 실행
    prepare()     : SQL 문장을 먼저 컴파일
    bind_param()  : 변수를 실제 SQL문에 바인딩 (int, string, double)
    execute()     : prepare + bind_param 된 값 실행
    get_result()  : 실행된 쿼리의 결과를 mysqli_result 객체로 반환
    fetch_assoc() : mysqli_result 객체에서 한 행을 연관 배열 형태로 가져옴
*/

// 모든 정보 조회
function getAllNotices($conn) {
    return $conn->query("SELECT * FROM test_notices ORDER BY id DESC");
}

// 특정 정보 조회 (id)
function getNoticeById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM test_notices WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// 추가 (제목, 내용)
function addNotice($conn, $title, $content) {
    $stmt = $conn->prepare("INSERT INTO test_notices (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    return $stmt->execute();
}

// 수정 (id, 제목, 내용)
function updateNotice($conn, $id, $title, $content) {
    $stmt = $conn->prepare("UPDATE test_notices SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    return $stmt->execute();
}

// 삭제 (id)
function deleteNotice($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM test_notices WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

?>