<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task2</title>
</head>
<body style="margin: 10px">

<form method="post">
    <div style="margin:10px">
        <label>
            Your name:
            <input type="text" name="name">
        </label>
    </div>
    <div style="margin:10px">
        <label>
            Your age:
            <input type="number" name="age">
        </label>
    </div>

    <button type="submit" style="margin:10px">Submit</button>
</form>

<div style="margin:10px">
    <?php
    if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['age']) && $_POST['age'] != '') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        echo "Hello! My name is '$name'<br>";
        echo "I`m $age";
    }
    ?>
</div>

</body>
</html>