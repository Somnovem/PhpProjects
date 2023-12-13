<?php
$tag = $_POST['tag'] ?? 'div';
$background_color = $_POST['background_color'] ?? 'white';
$color = $_POST['$color'] ?? 'black';
$width = $_POST['width'] ?? '150px';
$height = $_POST['height'] ?? '150px';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task6</title>
</head>
<body style="margin: 10px">

<form method="post" style="margin: 10px">
    <div style="margin: 10px">
        <label>
            Tag:
            <input type="text" id="tag" name="tag" value="<?php echo $tag; ?>" required>
        </label>
    </div>

    <div style="margin: 10px">
        <label>
            Background Color:
            <input type="text" id="background_color" name="background_color" value="<?php echo $background_color; ?>" required>
        </label>
    </div>

    <div style="margin: 10px">
        <label>
            Text Color:
            <input type="text" id="color" name="color" value="<?php echo $color; ?>" required>
        </label>
    </div>

    <div style="margin: 10px">
        <label>
            Width:
            <input type="text" id="width" name="width" value="<?php echo $width; ?>" required>
        </label>
    </div>

    <div style="margin: 10px">
        <label>
            Height:
            <input type="text" id="height" name="height" value="<?php echo $height; ?>" required>
        </label>
    </div>

    <button type="submit" style="margin: 10px">Update style</button>
</form>

<div style="margin: 10px">
    <?php
    echo "<$tag style=' background-color: $background_color; 
                        color: $color; width: $width; 
                        height: $height;
                       '>";
    echo "This is a < $tag > tag with custom styles.</$tag>";
    ?>
</div>

</body>
</html>