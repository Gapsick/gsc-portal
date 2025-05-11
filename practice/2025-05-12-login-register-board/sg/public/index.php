<?php
session_start();

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'registerForm':
        require __DIR__ . '/../views/auth/register.php';
        break;
    case 'register':
        require __DIR__ . '/../controllers/AuthController.php';
        register();
        break;
    case 'loginForm':
        require __DIR__ . '/../views/auth/login.php';
        break;
    case 'login':
        require __DIR__ . '/../controllers/AuthController.php';
        login();
        break;
    case 'logout':
        session_destroy();
        header("Location: index.php");
        break;

    case 'createForm':
        require __DIR__ . '/../controllers/PostController.php';
        createForm();
        break;
    case 'create':
        require __DIR__ . '/../controllers/PostController.php';
        storePost();
        break;
    case 'list':
        require __DIR__ . '/../controllers/PostController.php';
        listPosts();
        break;
    case 'view':
        require __DIR__ . '/../controllers/PostController.php';
        showPost();
        break;
    case 'editForm':
        require __DIR__ . '/../controllers/PostController.php';
        showEditForm();
        break;
    case 'edit':
        require __DIR__ . '/../controllers/PostController.php';
        updatePost();
        break;
    case 'delete':
        require __DIR__ . '/../controllers/PostController.php';
        deletePost();
        break;

    default:
        require __DIR__ . '/../controllers/PostController.php';
        listPosts();
        break;
}
