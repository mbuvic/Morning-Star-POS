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
    // Retrieve POST variables
    $id = $_POST['memi'];
    $a = $_POST['code'];
    $z = $_POST['gen'];
    $b = $_POST['name'];
    $c = $_POST['exdate'];
    $d = $_POST['price'];
    $e = $_POST['supplier'];
    $f = $_POST['qty'];
    $g = $_POST['o_price'];
    $h = $_POST['profit'];
    $i = $_POST['date_arrival'];
    $j = $_POST['sold'];

    // Log the received POST variables
    logMessage("Received POST variables: id=$id, code=$a, gen=$z, name=$b, exdate=$c, price=$d, supplier=$e, qty=$f, o_price=$g, profit=$h, date_arrival=$i, sold=$j");

    // Prepare the SQL statement
    $sql = "UPDATE products 
            SET product_code=?, gen_name=?, product_name=?, expiry_date=?, price=?, supplier=?, qty=?, o_price=?, profit=?, date_arrival=?, qty_sold=?
            WHERE product_id=?";
    $q = $db->prepare($sql);

    // Execute the SQL statement
    $q->execute(array($a, $z, $b, $c, $d, $e, $f, $g, $h, $i, $j, $id));

    // Log successful update
    logMessage("Successfully updated product with id=$id.");

    // Redirect to products.php
    header("location: products.php");
    exit;

} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check the log for details.";
}
?>
