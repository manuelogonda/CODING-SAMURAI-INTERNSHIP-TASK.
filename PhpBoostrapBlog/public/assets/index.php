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



// Load page or 404
if (file_exists($file_path)) {
    require_once $file_path;
} else {
    require_once $not_found;
}

