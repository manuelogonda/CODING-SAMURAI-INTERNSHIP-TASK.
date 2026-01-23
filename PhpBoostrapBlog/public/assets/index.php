<?php
session_start();
require_once __DIR__ . '/../../app/core/init.php';

$url = $_GET['url'] ?? 'home';
$url = strtolower(trim($url, '/'));
$url = explode('/', $url);

$page_name = trim($url[0]);

$basePath  = BASE_PATH . '/app/pages/';
$file_path = $basePath . $page_name . '.php';
$not_found = $basePath . '404.php';


// Set pagination vars (used by pages like admin/users)
if ($page_name === 'admin' && isset($url[1]) && $url[1] === 'users') {
    $PAGE = get_pagination();
} else {
    $PAGE = [
        'current_page_number' => 1,
        'first_page_link'     => '',
        'prev_page_link'      => '',
        'next_page_link'      => '',
    ];
}

// Load page or 404
if (file_exists($file_path)) {
    require_once $file_path;
} else {
    require_once $not_found;
}

