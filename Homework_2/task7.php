<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task7</title>
</head>
<body style="margin: 10px">
<?php
$x = 50;
$y = 50;
$color = "Green";
echo "X = $x, Y = $y, Color = $color";
?>

<script>
    const maxWidth = window.innerWidth || document.body.clientWidth;
    const maxHeight = window.innerHeight || document.body.clientHeight;

    const x = <?php echo $x;?>;
    const y = <?php echo $y;?>;
    const div = document.createElement("div");
    if ((x >= 0 && x <= maxWidth) && (y >= 0 && y <= maxHeight)) {
        div.style.width = "100px";
        div.style.height = "100px";
        div.style.left = "<?php echo $x;?>px";
        div.style.top = "<?php echo $y;?>px";
        div.style.position = "absolute";
        div.style.backgroundColor = "<?php echo $color;?>";
    }
    else {
        div.innerHTML = "<p>Input coords are outside the page!</p>";
        div.style.color = 'red';
    }
    document.body.appendChild(div);
</script>

</body>
</html>