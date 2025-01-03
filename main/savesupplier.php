<?php
session_start();
include('../connect.php');

// Function to log messages to log.txt
function logMessage($message) {
    $logFile = 'log.txt';
    $currentTime = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$currentTime] $message" . PHP_EOL, FILE_APPEND);
}

try {
    // Retrieve and sanitize POST variables
    $a = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $b = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $c = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
    $d = filter_var($_POST['cperson'], FILTER_SANITIZE_STRING);
    $e = filter_var($_POST['note'], FILTER_SANITIZE_STRING);

    // Log the received POST variables
    logMessage("Received POST variables: name=$a, address=$b, contact=$c, cperson=$d, note=$e");

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO supliers (suplier_name, suplier_address, suplier_contact, contact_person, note) 
            VALUES (:a, :b, :c, :d, :e)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e));

    // Log successful insertion
    logMessage("Inserted new suplier into supliers table: name=$a, address=$b, contact=$c, cperson=$d, note=$e");

    // Redirect to suplier.php
    header("location: supplier.php");
    exit();
} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check the log for details.";
}
?>
