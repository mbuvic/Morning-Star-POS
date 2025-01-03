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
    $d = filter_var($_POST['memno'], FILTER_SANITIZE_STRING);
    $e = filter_var($_POST['prod_name'], FILTER_SANITIZE_STRING);
    $f = filter_var($_POST['note'], FILTER_SANITIZE_STRING);
    $g = filter_var($_POST['date'], FILTER_SANITIZE_STRING);

    // Log the received POST variables
    logMessage("Received POST variables: name=$a, address=$b, contact=$c, memno=$d, prod_name=$e, note=$f, date=$g");

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO customer (customer_name, address, contact, membership_number, prod_name, note, expected_date) 
            VALUES (:a, :b, :c, :d, :e, :f, :g)";
    $q = $db->prepare($sql);
    $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':f' => $f, ':g' => $g));

    // Log successful insertion
    logMessage("Inserted new customer into customer table: name=$a, address=$b, contact=$c, memno=$d, prod_name=$e, note=$f, date=$g");

    // Redirect to customer.php
    header("location: customer.php");
    exit();
} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check the log for details.";
}
?>
