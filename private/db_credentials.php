<?php

// Keep database credentials in a separate file
// 1. Easy to exclude this file from source code managers
// 2. Unique credentials on development and production servers
// 3. Unique credentials if working with multiple developers




if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '192.168.64.2') {
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "tonotedb");
}else{
    define("DB_SERVER", "localhost");
    define("DB_USER", "tonote_user");
    define("DB_PASS", "@G3t2n0t3#");
    define("DB_NAME", "document_management");
}




?>