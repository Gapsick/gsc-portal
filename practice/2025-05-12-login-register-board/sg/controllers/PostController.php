<?php
require_once __DIR__ . '/../models/Post.php';

// 작성
function createForm() {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('로그인이 필요합니다.'); location.href='index.php?action=loginForm';</script>";
        exit;
    }

    $mode = 'create';
    require __DIR__ . '/../views/posts/form.php';
}

// 글 작성
function storePost() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $user_id = $_SESSION['user_id'] ?? null;

        // 로그인 확인
        if (!$user_id) {
            echo "<script>alert('로그인 후 작성해주세요.'); location.href='index.php?action=loginForm';</script>";
            return;
        }

        // 유효성 검사
        if ($title === '' || $content === '') {
            echo "<script>alert('제목과 내용을 모두 입력해주세요.'); history.back();</script>";
            return;
        }

        $result = Post::create($user_id, $title, $content);

        if ($result) {
            echo "<script>alert('글이 등록되었습니다.'); location.href='index.php?action=list';</script>";
        } else {
            echo "<script>alert('글 등록에 실패했습니다.'); history.back();</script>";
        }
    }
}

// 목록
function listPosts() {
    $posts = Post::getAll(); // 모델에서 글 가져오기
    require __DIR__ . '/../views/posts/list.php'; // 뷰로 전달
}

// 상세보기
function showPost() {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "<script>alert('잘못된 접근입니다.'); location.href='index.php?action=list';</script>";
        return;
    }

    $id = (int)$_GET['id'];
    $post = Post::findById($id);

    if (!$post) {
        echo "<script>alert('존재하지 않는 게시글입니다.'); location.href='index.php?action=list';</script>";
        return;
    }

    require __DIR__ . '/../views/posts/view.php';
}

// 수정
function showEditForm() {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "<script>alert('잘못된 접근입니다.'); location.href='index.php?action=list';</script>";
        return;
    }

    $id = (int)$_GET['id'];
    $post = Post::findById($id);

    if (!$post || $_SESSION['user_id'] != $post['user_id']) {
        echo "<script>alert('수정 권한이 없습니다.'); location.href='index.php?action=list';</script>";
        return;
    }

    $mode = 'edit';
    require __DIR__ . '/../views/posts/form.php';
}

// 수정
function updatePost() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $post_id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $user_id = $_SESSION['user_id'] ?? null;

        if (!$post_id || !$user_id || $title === '' || $content === '') {
            echo "<script>alert('유효하지 않은 요청입니다.'); history.back();</script>";
            return;
        }

        $result = Post::update($post_id, $user_id, $title, $content);

        if ($result) {
            echo "<script>alert('수정되었습니다.'); location.href='index.php?action=view&id=$post_id';</script>";
        } else {
            echo "<script>alert('수정에 실패했습니다.'); history.back();</script>";
        }
    }
}


// 삭제
function deletePost() {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "<script>alert('잘못된 요청입니다.'); location.href='index.php?action=list';</script>";
        return;
    }

    $post_id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        echo "<script>alert('로그인이 필요합니다.'); location.href='index.php?action=loginForm';</script>";
        return;
    }

    $result = Post::delete($post_id, $user_id);

    if ($result) {
        echo "<script>alert('삭제되었습니다.'); location.href='index.php?action=list';</script>";
    } else {
        echo "<script>alert('삭제 실패 또는 권한이 없습니다.'); location.href='index.php?action=view&id=$post_id';</script>";
    }
}
