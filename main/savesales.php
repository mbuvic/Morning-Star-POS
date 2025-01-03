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
    $discount = filter_var($_POST['discount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $a = filter_var($_POST['invoice'], FILTER_SANITIZE_STRING);
    $b = filter_var($_POST['cashier'], FILTER_SANITIZE_STRING);
    $c = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
    $d = filter_var($_POST['ptype'], FILTER_SANITIZE_STRING);
    $e = floatval($_POST['amount']) - $discount;
    $z = floatval($_POST['profit']) - $discount;
    $cname = filter_var($_POST['cname'], FILTER_SANITIZE_STRING);
    $tdisc = filter_var($_POST['tdisc'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $discsum = $tdisc + $discount;
    $pmethod = filter_var($_POST['pmethod'], FILTER_SANITIZE_STRING);

    // Log the received POST variables
    logMessage("Received POST variables: invoice=$a, cashier=$b, date=$c, ptype=$d, amount=$e, profit=$z, cname=$cname, tdisc=$tdisc, pmethod=$pmethod, discount=$discount");

    // Prepare the common SQL statement
    $sql = "INSERT INTO sales (invoice_number, cashier, date, type, amount, profit, due_date, name, pmethod, sdiscount) VALUES (:a, :b, :c, :d, :e, :z, :f, :g, :pm, :sd)";
    $q = $db->prepare($sql);

    if ($d == 'credit') {
        $f = filter_var($_POST['due'], FILTER_SANITIZE_STRING);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':z' => $z, ':f' => $f, ':g' => $cname, ':pm' => $pmethod, ':sd' => $discsum));
        logMessage("Inserted into sales table for credit payment.");
        header("location: preview.php?invoice=$a");
        exit();
    }

    if ($d == 'cash') {
        $f = filter_var($_POST['cash'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $q->execute(array(':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':e' => $e, ':z' => $z, ':f' => $f, ':g' => $cname, ':pm' => $pmethod, ':sd' => $discsum));
        logMessage("Inserted into sales table for cash payment.");

        // Check if the customer exists
        $qry = $db->prepare("SELECT * FROM customer WHERE customer_name = :cname");
        $qry->bindParam(':cname', $cname);
        $qry->execute();

        // Check whether the query was successful or not
        if ($qry->rowCount() > 0) {
            logMessage("Customer $cname found in customer table.");
        } else {
            $sql = "INSERT INTO customer (customer_name) VALUES (:h)";
            $q = $db->prepare($sql);
            $q->execute(array(':h' => $cname));
            logMessage("Inserted new customer $cname into customer table.");
        }

        header("location: preview.php?invoice=$a");
        exit();
    }
} catch (Exception $e) {
    // Log any exceptions
    logMessage("Error occurred: " . $e->getMessage());
    echo "An error occurred. Please check the log for details.";
}
?>
