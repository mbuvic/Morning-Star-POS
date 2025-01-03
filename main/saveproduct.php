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
    $a = $_POST['code'];
    $b = $_POST['name'];
    $c = $_POST['exdate'];
    $d = $_POST['price'];
    $e = $_POST['supplier'];
    $f = $_POST['qty'];
    $g = $_POST['o_price'];
    $h = $_POST['profit'];
    $i = $_POST['gen'];
    $j = $_POST['date_arrival'];
    $k = $_POST['qty_sold'];
    $l = $_POST['bcode'];

    // Log the received POST variables
    logMessage("Received POST variables: code=$a, name=$b, exdate=$c, price=$d, supplier=$e, qty=$f, o_price=$g, profit=$h, gen_name=$i, date_arrival=$j, qty_sold=$k, b_code=$l");

    // Prepare the SQL statement
    $sql = "INSERT INTO products (product_code, product_name, expiry_date, price, supplier, qty, o_price, profit, gen_name, date_arrival, qty_sold, b_code) 
            VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l)";
    $q = $db->prepare($sql);

    // Execute the SQL statement
    $q->execute(array(
        ':a' => $a,
        ':b' => $b,
        ':c' => $c,
        ':d' => $d,
        ':e' => $e,
        ':f' => $f,
        ':g' => $g,
        ':h' => $h,
        ':i' => $i,
        ':j' => $j,
        ':k' => $k,
        ':l' => $l
    ));

    // Log successful insertion
    logMessage("Successfully inserted product with code=$a into the products table.");

    // Redirect to products.php
    header("location: products.php");
    exit;

} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check the log for details.";
}
?>
