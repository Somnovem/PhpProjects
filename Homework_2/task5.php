<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task5</title>
</head>
<body style="margin: 10px">
<div style="margin: 10px">
    <?php
    $num1 = rand(0, 1000);
    $num2 = rand(0, 1000);

    if ($num1 % 3 == 0 && $num2 % 3 == 0) {
        $sum = $num1 + $num2;
        echo "The sum = $sum";
    }
    elseif ($num2 != 0) {
        $quotient = ($num1 / $num2);
        echo "The quotient = " . number_format($quotient, 3);
    }
    else {
        echo "Invalid input(Can't divide by zero)";
    }
    ?>
</div>
</body>
</html>