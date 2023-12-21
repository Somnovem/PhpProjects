<?php
require_once 'Models/User.php';
require_once 'Models/SoldProduct.php';
$user1 = new User(1,'User1', 'user1@example.com');
$user2 = new User(2,'User2', 'user2@example.com');
$user3 = new User(3,'User3', 'user3@example.com');
$user4 = new User(4,'User4', 'user4@example.com');
$user5 = new User(5,'User5', 'user5@example.com');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>

<ul>
    <li><a href="session.php?userId=<?= $user1->getId() ?>"><?php echo $user1->getUser(); ?></a></li>
    <li><a href="session.php?userId=<?= $user2->getId() ?>"><?php echo $user2->getUser(); ?></a></li>
    <li><a href="session.php?userId=<?= $user3->getId() ?>"><?php echo $user3->getUser(); ?></a></li>
    <li><a href="session.php?userId=<?= $user4->getId() ?>"><?php echo $user4->getUser(); ?></a></li>
    <li><a href="session.php?userId=<?= $user5->getId() ?>"><?php echo $user5->getUser(); ?></a></li>
</ul>

</body>
</html>
