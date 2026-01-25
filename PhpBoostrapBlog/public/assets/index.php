<?php
session_start();
require_once __DIR__ . '/../../app/core/init.php';

$url_string = $_GET['url'] ?? 'home';
$url        = explode('/', trim($url_string, '/'));

$page_name = trim($url[0]) ?? 'home';
$sub_page  = $url[1] ?? null;

$basePath  = BASE_PATH . '/app/pages/';
$file_path = $basePath . $page_name . '.php';
$not_found = $basePath . '404.php';

switch ($page_name) {
    case 'admin':
        require_once  __DIR__ . '/../../app/pages/admin.php';
        break;

    case 'home':
       require_once  __DIR__ .  '/../../app/pages/home.php';
        break;

     case 'search':
        require_once  __DIR__ . '/../../app/pages/search.php';
        break;

    case 'blog':
        require_once   __DIR__ . '/../../app/pages/blog.php';
        break;

    case 'contact':
        require_once   __DIR__ . '/../../app/pages/contact.php';
        break;
    
    case 'post':
    require_once __DIR__ . '/../../app/pages/blog-single.php';
    break;

    default:
        require_once   __DIR__ . '/../../app/pages/404.php';
        break;
}

// Load page or 404
if (file_exists($file_path)) {
    require_once $file_path;
} else {
    require_once $not_found;
}

