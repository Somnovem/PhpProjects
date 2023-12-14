<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task6</title>
</head>
<body style="margin: 10px">

<?php
$session_id = rand(0, 1);
?>

<?php
if ($session_id == 0)
    {
?>
    <form method="post" style="margin: 10px">
        <h2>Please register</h2>
        <p>Session ID: <?php echo $session_id; ?></p>
        <div style="margin: 10px; display: flex; flex-direction: column">
            <label>
                <input type="text" name="login" id="login" placeholder="Login" required>
            </label>
            <label>
                <input type="password" name="pass" placeholder="Password" required>
            </label>
        </div>
        <button type="submit" style="margin: 10px">Create account</button>
    </form>
<?php
    }
else {
    echo "<h2>You are already registered. Log in!</h2>";
    echo "<p>Session ID: $session_id";
}
?>

</body>
</html>