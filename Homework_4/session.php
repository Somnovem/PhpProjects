<?php
require_once 'Models/User.php';
require_once 'Models/SoldProduct.php';
$user1 = new User(1,'User1', 'user1@example.com');
$user2 = new User(2,'User2', 'user2@example.com');
$user3 = new User(3,'User3', 'user3@example.com');
$user4 = new User(4,'User4', 'user4@example.com');
$user5 = new User(5,'User5', 'user5@example.com');

$product1 = new SoldProduct('2023-01-01 10:00:00',"Name: Galaxy S10, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5634);
$product2 = new SoldProduct('2023-01-02 12:30:00',"Name: Galaxy S9, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5735);
$product3 = new SoldProduct('2023-01-03 15:45:00',"Name: Galaxy S6, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5634);
$product4 = new SoldProduct('2023-01-04 08:20:00',"Name: Galaxy S7, Price: $1000, Brand: Samsung, CPU:Snapdragon 860...", 5735);

$user1->addBoughtProduct($product1);
$user1->addBoughtProduct($product2);
$user2->addBoughtProduct($product2);
$user2->addBoughtProduct($product3);
$user3->addBoughtProduct($product3);
$user3->addBoughtProduct($product4);
$user4->addBoughtProduct($product2);
$user4->addBoughtProduct($product4);
$user5->addBoughtProduct($product1);
$user5->addBoughtProduct($product3);
$users[] = $user1;
$users[] = $user2;
$users[] = $user3;
$users[] = $user4;
$users[] = $user5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session</title>
</head>
<body>

<?php
if (isset($_GET['userId'])) {
    $userId = intval(htmlspecialchars($_GET['userId'], ENT_QUOTES, 'UTF-8'));
    foreach ($users as $user){
        if ($user->getId() == $userId){
            $currentUser = $user;
        }
    }
    echo "<ul>";
    foreach ($currentUser->getBoughtProducts() as $product) {
        echo "<li>" . $product->getTime() . " - " . "<a href=cart.php?sessionId=". $product->getSessionId() . ">" . $product->getSessionId() . "</a>" ."</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Error: User information not provided.</p>";
}
?>

</body>
</html>
