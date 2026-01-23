<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASS", "");
define("DB_NAME", "php_bootstrap_blog");
} else {
//Production server database credentials
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASS", "");
define("DB_NAME", "php_bootstrap_blog");
}