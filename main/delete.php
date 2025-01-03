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
    // Get parameters from GET request
    $id = $_GET['id'];
    $invoice = $_GET['invoice'];
    $dle = $_GET['dle'];
    $qty = $_GET['qty'];
    $code = $_GET['code'];

    // Log received parameters
    logMessage("Received parameters: id=$id, invoice=$invoice, dle=$dle, qty=$qty, code=$code");

    // Update product quantity
    $sqlUpdate = "UPDATE products SET qty = qty + ? WHERE product_id = ?";
    $qUpdate = $db->prepare($sqlUpdate);
    $qUpdate->execute([$qty, $code]);

    // Log update query execution
    logMessage("Updated product quantity: Increased by $qty for product_id=$code");

    // Delete from sales_order table
    $sqlDelete = "DELETE FROM sales_order WHERE transaction_id = :memid";
    $qDelete = $db->prepare($sqlDelete);
    $qDelete->bindParam(':memid', $id);
    $qDelete->execute();

    // Log delete query execution
    logMessage("Deleted sales order entry with transaction_id=$id");

    // Redirect to sales.php with parameters
    header("location: sales.php?id=$dle&invoice=$invoice");
    exit;
} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check log for details.";
}
?>
