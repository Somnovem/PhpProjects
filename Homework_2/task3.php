<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task3</title>
</head>
<body style="margin: 10px">
<div style="margin: 10px">
    <?php
    $month = 2;
    $days = cal_days_in_month(CAL_GREGORIAN,$month,date("Y"));
    echo "<h3>Month = $month</h3>";
    echo "<h3>Days in the month: $days</h3>";
    ?>
</div>
</body>