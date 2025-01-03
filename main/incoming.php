<?php
session_start();
include('../connect.php');

function logMessage($message) {
    $logFile = 'log.txt';
    $currentTime = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$currentTime] $message" . PHP_EOL, FILE_APPEND);
}

$bcode = ($_POST['bcode'] ? $_POST['bcode'] : 'Null');
$invoice = $_POST['invoice'];
$productIdOrBarcode = $_POST['product'];
$quantityRequested = intval($_POST['qty']);
$redirectId = $_POST['pt'];
$date = $_POST['date'];
$sellingPrice = intval($_POST['sellingprice']);

logMessage("Received input: bcode=$bcode, invoice=$invoice, product=$productIdOrBarcode, qty=$quantityRequested, pt=$redirectId, date=$date, sellingprice=$sellingPrice");

// Check if a product exists with the given product_id or b_code
$query = $db->prepare("SELECT * FROM products WHERE product_id = :productIdOrBarcode OR b_code = :bcode");
$query->bindParam(':productIdOrBarcode', $productIdOrBarcode);
$query->bindParam(':bcode', $bcode);
$query->execute();
logMessage("Executed product search query.");

if ($query->rowCount() === 0) {
    // No matching product found, display an alert and redirect to sales.php after the alert is closed
    logMessage("No product found with the provided barcode or product ID.");
    echo '<script>
            alert("No product was found with the provided barcode.");
            window.location.href = "sales.php?id=' . $redirectId . '&invoice=' . $invoice . '";
          </script>';
    exit;
}

$product = $query->fetch();
$productId = $product['product_id'];
$productCode = $product['product_code'];
$productName = $product['product_name'];
$genericName = $product['gen_name'];
$originalPrice = $product['o_price'];
$stockQuantity = intval($product['qty']);

logMessage("Product found: product_id=$productId, product_code=$productCode, product_name=$productName, gen_name=$genericName, o_price=$originalPrice, qty=$stockQuantity");

// Check if the product is in stock
if ($stockQuantity == 0) {
    logMessage("Product $genericName is out of stock.");
    echo '<script>
            alert("This product (' . $genericName . ') is out of stock.");
            window.location.href = "sales.php?id=' . $redirectId . '&invoice=' . $invoice . '";
          </script>';
    exit;
}

// Check if the quantity requested is greater than the quantity in stock
if ($quantityRequested > $stockQuantity) {
    $quantityToProcess = $stockQuantity;
    $alertMessage = "Only " . $stockQuantity . " " . ($stockQuantity == 1 ? 'unit' : 'units') . " of $genericName " . ($stockQuantity == 1 ? 'is' : 'are') . " remaining and has been processed.";
    logMessage($alertMessage);
} else {
    $quantityToProcess = $quantityRequested;
    logMessage("Requested quantity $quantityRequested is available.");
}

// Determine the selling price
if (empty($sellingPrice)) {
    $finalSellingPrice = $product['price'];
    logMessage("Using default selling price: $finalSellingPrice");
} elseif ($product['price'] * 0.8 > $sellingPrice) {
    logMessage("Provided selling price $sellingPrice is lower than 80% of the product price.");
    echo '<script>
            alert("The selling price provided is lower than 80% of the selling price.");
            window.location.href = "sales.php?id=' . $redirectId . '&invoice=' . $invoice . '";
          </script>';
    exit;
} else {
    $finalSellingPrice = $sellingPrice;
    logMessage("Using provided selling price: $finalSellingPrice");
}

// Update product quantity
$updateQuery = $db->prepare("UPDATE products SET qty = qty - ? WHERE product_id = ? OR b_code = ?");
$updateQuery->execute([$quantityToProcess, $productId, $bcode]);
logMessage("Updated product quantity: Decreased by $quantityToProcess for product_id=$productId or b_code=$bcode");

$totalAmount = $finalSellingPrice * $quantityToProcess;
$profit = ($finalSellingPrice - $originalPrice) * $quantityToProcess;

logMessage("Calculated totals: amount=$totalAmount, profit=$profit");

// Insert sales order
$insertQuery = $db->prepare("INSERT INTO sales_order (invoice, product, qty, amount, name, price, profit, product_code, gen_name, date) VALUES (:invoice, :product, :quantity, :amount, :name, :price, :profit, :productCode, :genName, :date)");
$insertQuery->execute([
    ':invoice' => $invoice,
    ':product' => $productId,
    ':quantity' => $quantityToProcess,
    ':amount' => $totalAmount,
    ':name' => $productName,
    ':price' => $finalSellingPrice,
    ':profit' => $profit,
    ':productCode' => $productCode,
    ':genName' => $genericName,
    ':date' => $date,
]);
logMessage("Inserted sales order.");

if (isset($alertMessage)) {
    echo '<script>
            alert("' . $alertMessage . '");
            window.location.href = "sales.php?id=' . $redirectId . '&invoice=' . $invoice . '";
          </script>';
    logMessage("Displayed alert: $alertMessage");
    exit;
}

logMessage("Redirecting to sales.php with id=$redirectId and invoice=$invoice");
header("Location: sales.php?id=$redirectId&invoice=$invoice");
exit;
?>
