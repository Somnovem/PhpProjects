<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task2</title>
</head>
<body style="margin: 10px">

<form method="post" style="margin: 10px">
    <div style="margin: 10px">
        <label>
            Enter first num:
            <input type="number" name="num1" required>
        </label>
    </div>

    <div style="margin: 10px">
        <label>
            Enter second num:
            <input type="number" name="num2" required>
        </label>
    </div>

    <button type="submit" style="margin: 10px">Check</button>
</form>

<div style="margin: 10px">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["num1"] ?? '';
        $num2 = $_POST["num2"] ?? '';
        if (is_numeric($num1) && is_numeric($num2)) {
            $max = ($num1 > $num2) ? $num1 : $num2;
            echo "Square of max num equals: " . $max*$max;
        }
        else {
            echo "Invalid format";
        }
    }
    ?>
</div>

</body>
</html>