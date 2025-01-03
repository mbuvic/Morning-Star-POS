<?php
/* Setting the default timezone */
date_default_timezone_set('Africa/Nairobi');

/* Database configuration */
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_database = 'sales';

try {
    /* Database connection using PDO */
    $db = new PDO("mysql:host=$db_host;dbname=$db_database", $db_user, $db_pass);
    /* Set error mode to exception */
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /* Optionally, you can set the PDO default fetch mode to FETCH_ASSOC for easier array handling */
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    /* Handle connection error */
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
