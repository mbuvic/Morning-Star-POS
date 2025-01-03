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
    // Get the product ID from GET parameters
    $id = $_GET['id'];

    // Log the received product ID
    logMessage("Received request to delete product with id=$id.");

    // Prepare the SQL statement to delete the product
    $result = $db->prepare("DELETE FROM products WHERE product_id= :memid");
    $result->bindParam(':memid', $id);

    // Execute the SQL statement
    $result->execute();

    // Log successful deletion
    logMessage("Successfully deleted product with id=$id.");
} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check the log for details.";
}
?>
