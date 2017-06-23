<?php
    define('DB_NAME', 'slurradi_main');
    define('DB_USER', 'slurradi_main');
    define('DB_PASSWORD', 'voq@XqhrnXKK');
    define('DB_HOST', 'localhost');

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

    if (!$conn) {
        die('Could not connect: ' .mysqli_error($conn));
    }

    $db_selected = mysqli_select_db($conn, DB_NAME);
?>