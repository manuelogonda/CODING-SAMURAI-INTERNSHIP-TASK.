<?php
require_once 'connection.php'; 

// function to query database
function querry_db($sql, $params = [])
{
    // use pdo to connect to database
    $dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dns, DB_USERNAME, DB_PASS, $options);

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $result = $stmt->fetchAll();
    if (is_array($result) && !empty($result)) {
        return $result;
    }
    return false;
}

function querry__row($sql, $params = [])
{
    // use pdo to connect to database
    $dns = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dns, DB_USERNAME, DB_PASS, $options);

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $result = $stmt->fetchAll();
    if (is_array($result) && !empty($result)) {
        return $result[0];
    }
    return false;
}
//to get the old select value
function old_select(string $key, $optionValue, $default = null): string
{
    if (isset($_POST[$key])) {
        return ($_POST[$key] == $optionValue) ? 'selected' : '';
    }

    if ($default !== null && $default == $optionValue) {
        return 'selected';
    }

    return '';
}

// function to get image path
function get_image($image)
{
    $image = $image ?? '';

    if (!empty($image)) {
        $disk_path = BASE_PATH . '/public/assets/images/' . $image;

        if (file_exists($disk_path)) {
            return ROOT . '/images/' . $image;
        }
    }
    return ROOT . '/images/default.jpg';
}

// pagination function
function get_pagination()
{
    $page_number = $_GET['page'] ?? 1;
    $page_number = empty($page_number) ? 1 : (int)$page_number;

    $next_page_number = $page_number + 1;
    $prev_page_number = $page_number > 1 ? $page_number - 1 : 1;

    $base = ROOT . "/index.php?url=admin/users";

    $result = [
        'current_page_number' => $page_number,
        'first_page_link'     => $base . "&page=1",
        'prev_page_link'      => $base . "&page=" . $prev_page_number,
        'next_page_link'      => $base . "&page=" . $next_page_number,
    ];

    return $result;
}
// check if user is logged in
function logged_in()
{
    if (!empty($_SESSION['USER'])) {
        return true;
    }
    return false;
}

// redirect function
function redirect($page)
{
    header("Location: " . $page);
    exit();
}

// escape function to prevent xss
function esc($str)
{
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// string to url friendly function
function string_to_url($url)
{
    $url = preg_replace('~/[^\\pL0-9_]/+~u', '-', $url);
    $url = str_replace("'", "", $url);
    $url = trim($url, '-');
    $url = iconv('utf-8', 'us-ascii//TRANSLIT', $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
    return $url;
}

// authentication function
function authenticate($user)
{
    $_SESSION['USER'] = $user;
    if (!empty($_SESSION['USER'])) {
        return true;
    }
    return false;
}

// inputs retain their values after form submission
function old_value($key, $default = "")
{
    if (!empty($_POST[$key])) {
        return htmlspecialchars($_POST[$key], ENT_QUOTES, 'UTF-8');
    }
    return $default;
}

// checkboxes retain their checked status after form submission
function old_checked($key, $default = "")
{
    if (!empty($_POST[$key])) {
        return "checked";
    }
    return $default;
}

// function to create database and tables if they do not exist
function create_tables()
{
    $dns = "mysql:host=" . DB_HOST . ";charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dns, DB_USERNAME, DB_PASS, $options);

    // create database
    $create_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    $stmt = $pdo->prepare($create_db);
    $stmt->execute();

    $use_db = "USE " . DB_NAME;
    $stmt = $pdo->prepare($use_db);
    $stmt->execute();

    // Users table
    $create_users_table = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        image VARCHAR(1024) NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        role VARCHAR(10) NOT NULL,
        KEY username (username),
        KEY email (email)
    );";
    $stmt = $pdo->prepare($create_users_table);
    $stmt->execute();

    // Categories table
    $create_categories_table = "CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(50) NOT NULL,
        slug VARCHAR(100) NOT NULL,
        disabled TINYINT(1) DEFAULT 0,
        KEY category (category),
        KEY slug (slug)
    );";
    $stmt = $pdo->prepare($create_categories_table);
    $stmt->execute();

    // Posts table
    $create_posts_table = "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        category_id INT NOT NULL,
        title VARCHAR(100) NOT NULL,
        content TEXT NULL,
        image VARCHAR(1024) NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        slug VARCHAR(255) NOT NULL,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        KEY title (title),
        KEY slug (slug),
        KEY user_id (user_id),
        KEY category_id (category_id),
        KEY date (date)
    );";
    $stmt = $pdo->prepare($create_posts_table);
    $stmt->execute();
}

create_tables();

