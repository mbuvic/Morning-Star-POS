<?php
include('../connect.php');

// Function to log messages to log.txt
function logMessage($message) {
    $logFile = 'log.txt';
    $currentTime = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$currentTime] $message" . PHP_EOL, FILE_APPEND);
}

try {
    // Retrieve and sanitize GET variable
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Log the received GET variable
    logMessage("Received GET variable: id=$id");

    // Prepare and execute the SQL statement
    $sql = "DELETE FROM customer WHERE customer_id = :memid";
    $q = $db->prepare($sql);
    $q->bindParam(':memid', $id, PDO::PARAM_INT);
    $q->execute();

    // Log successful deletion
    logMessage("Deleted customer with id=$id from customer table.");
} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check the log for details.";
}
?>
