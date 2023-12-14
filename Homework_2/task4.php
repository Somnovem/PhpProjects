<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task4</title>
</head>
<body style="margin: 10px">
<div style="margin: 10px">
    <?php
    $year = rand(0,9999);
    echo "<h3>Year = $year</h3>";
    if (( ($year % 4 == 0) && ($year % 100 != 0) ) || ($year % 400 == 0)) {
        echo "<h3>The year $year is a leap one";
    }
    else {
        echo "<h3>The year $year isn't a leap one";
    }
    ?>
</div>
</body>