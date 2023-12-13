<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task1</title>
</head>
<body style="margin: 10px">

<form method="post">
    <div style="margin:10px">
        <label>
            Your name:
            <input type="text" name="name">
        </label>
    </div>

    <button type="submit" style="margin:10px">Submit</button>
</form>

<div style="margin:10px">
    <?php
    if (isset($_POST['name']) && $_POST['name'] != '') {
        $name = $_POST['name'];
        echo "Hello! My name is '$name'";
    }
    ?>
</div>

</body>
</html>