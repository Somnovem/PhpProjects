<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task4</title>
</head>
<body style="margin: 10px">

<form method="post">
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

    <button type="submit" style="margin: 10px">Swap Numbers</button>
</form>

<div style="margin: 10px">
    <?php
    if (isset($_POST['num1']) && isset($_POST['num2'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];

        echo "<b>Original state:</b><br> 
              num1 = $num1<br>
              num2 = $num2";
        $num1 += $num2;
        $num2 = $num1 - $num2;
        $num1 -= $num2;
        echo "<br><br>";
        echo "<b>Swapped state:</b><br> 
              num1 = $num1<br>
              num2 = $num2";
    }
    ?>
</div>

</body>
</html>