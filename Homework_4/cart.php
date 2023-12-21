<?php
require_once 'Models/SoldProduct.php';
$product1 = new SoldProduct('2023-01-01 10:00:00',"Name: Galaxy S10, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5634);
$product2 = new SoldProduct('2023-01-02 12:30:00',"Name: Galaxy S9, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5735);
$product3 = new SoldProduct('2023-01-03 15:45:00',"Name: Galaxy S6, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5634);
$product4 = new SoldProduct('2023-01-04 08:20:00',"Name: Galaxy S7, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5735);
$products[] = $product1;
$products[] = $product2;
$products[] = $product3;
$products[] = $product4;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Info</title>
</head>
<body>
<?php
if (isset($_GET['sessionId'])) {
   $sessionId = intval(htmlspecialchars($_GET['sessionId'], ENT_QUOTES, 'UTF-8'));
    echo "<ul>";
    foreach ($products as $product){
        if ($product->getSessionId() == $sessionId){
            echo "<li>" . $product->getDescription() . "</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p>Error: User information not provided.</p>";
}
?>