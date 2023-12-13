<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task5</title>
</head>
<body style="margin: 10px">

<form method="post" style="margin: 10px">
    <div>
        <h3>1.Who is credited with the invention of the radio?</h3>
        <label>
            <input type="radio" name="question1" value="a">
            a)Thomas Edison
        </label>
        <br>
        <label>
            <input type="radio" name="question1" value="b">
            b)Nikola Tesla
        </label>
        <br>
        <label>
            <input type="radio" name="question1" value="c">
            c)Guglielmo Marconi
        </label>
        <br>
        <label>
            <input type="radio" name="question1" value="d">
            d)Alexander Graham Bell
        </label>
    </div>

    <div>
        <h3>2.Which of the following countries are members of the Union of European Football Associations (UEFA)?</h3>
        <label>
            <input type="checkbox" name="question2[]" value="a">
            a)Brazil
        </label>
        <label>
            <input type="checkbox" name="question2[]" value="b">
            b)Spain
        </label>
        <label>
            <input type="checkbox" name="question2[]" value="c">
            c)Australia
        </label>
        <label>
            <input type="checkbox" name="question2[]" value="d">
            d)Australia
        </label>
        <label>
            <input type="checkbox" name="question2[]" value="e">
            e)Italy
        </label>
        <label>
            <input type="checkbox" name="question2[]" value="f">
            f)Germany
        </label>
    </div>

    <div>
        <h3>3.Did Moash from SA do anything wrong?</h3>
        <label>
            <textarea name="question3" rows="5" cols="100" placeholder="Write your answer here..."></textarea>
        </label>
    </div>

    <button type="submit" style="margin: 10px">Submit</button>
</form>

<div style="margin: 10px">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h3>Results:</h3>";
        $question1_answer = $_POST['question1'];
        echo "<p>1) Your answer '$question1_answer' is " . ($question1_answer == 'c' ? 'correct' : 'incorrect') . "</p>";

        $question2_answer = implode(', ', $_POST['question2'] ?? []);
        echo "<p>2) Your answer '$question2_answer' is " . ($question2_answer == 'b, e, f' ? 'correct' : 'incorrect') . "</p>";

        $question3_answer = $_POST['question3'] ?? '';
        echo "<p>3) Your open-ended answer will be checked by an administrator shortly: $question3_answer</p>";
    }
    ?>
</div>

</body>
</html>