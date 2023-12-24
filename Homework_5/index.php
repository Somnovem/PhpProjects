<?php
require_once 'Controls/Checkbox.php';
require_once 'Controls/Radio.php';
require_once 'Controls/Select.php';
$select = new Select('white', 120, 20, 'selectBox', 'selectedValue', ['Select Country', 'Ukraine','USA','United Kingdom','Germany','France']);
$radio1 = new Radio('white', 15, 15, 'radioGender', 'male',false);
$radio2 = new Radio('white', 15, 15, 'radioGender', 'female',false);
$checkbox = new Checkbox('red', 15, 15, 'subscribe', 'subscribe',false);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
<label for="textFN" style="width:100px; height: 50px; background-color: white;">First Name
    <input type="text" name="textFN" placeholder="First Name" style="width:100px; height: 50px; background-color: white;">
</label>
<br>
<label for="textLN" style="width:100px; height: 50px; background-color: white;">Last Name
    <input type="text" name="textLN" placeholder="Last Name" style="width:100px; height: 50px; background-color: white;">
</label>
<br>
<label for="textEM" style="width:100px; height: 50px; background-color: white;">Email
    <input type="text" name="textEM" placeholder="Email" style="width:100px; height: 50px; background-color: white;">
</label>
<br>
<label for="textPN" style="width:100px; height: 50px; background-color: white;">Phone
    <input type="text" name="textPN" placeholder="Phone" style="width:100px; height: 50px; background-color: white;">
</label>
<br>
<?php
    echo $select->render();
?>
<br>
<?php
    echo $radio1->render();
?>
<label for="text1" style="width:100px; height: 50px; background-color: white;">Male</label>
<br>
<?php
    echo $radio2->render();
?>
<label for="text2" style="width:100px; height: 50px; background-color: white;">Female</label>
<br>
<?php
echo $checkbox->render();
?>
<label for="text3" style="width:100px; height: 50px; background-color: white;">Subscribe</label>
<br>
<input type="submit" name="btnSubmit" value="Send" style="width: 200px; height: 20px; background-color: green;">
</body>
</html>