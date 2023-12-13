<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task3</title>
</head>
<body style="margin:10px">

<form method="post">
    <div style="margin:10px">
        <label>
            Enter first num:
            <input type="number" name="num1" required>
        </label>
    </div>

    <div style="margin: 10px">
        <label>
            Select operation:
            <select id="sign" name="sign" required>
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
        </label>
    </div>

    <div style="margin: 10px">
        <label>
            Enter second num:
            <input type="number" name="num2" required>
        </label>
    </div>

    <button type="submit" style="margin: 10px">Submit</button>
</form>

<div style="margin: 10px">
    <?php
    if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['sign'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $sign = $_POST['sign'];

        switch ($sign) {
            case '+':
                $result = $num1 + $num2;
                $signPublic = '+';
                break;
            case '-':
                $result = $num1 - $num2;
                $signPublic = '-';
                break;
            case '*':
                $result = $num1 * $num2;
                $signPublic = '*';
                break;
            case '/':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = 'Undefined(can\'t divide by zero)';
                }
                $signPublic = '/';
                break;
            default:
                $result = '';
                $signPublic = '';
        }

        echo "$num1 $signPublic $num2 = $result";
    }
    ?>
</div>

</body>
</html>