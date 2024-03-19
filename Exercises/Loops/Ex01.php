<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Even - Odd Game</title>
</head>
<body>
    <form method="post">
        <label for="number">Limite:</label>
        <input type="number" id="number" name="number" required>
        <button type="submit">Lancer</button>
    </form>
    <?php

    function evenOdd($iterations) {
        for ($i = 0; $i <= $iterations; $i++) {
            echo ($i % 2 == 0) ? "$i est pair <br/>" : "$i est impair <br/>";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['number']) && is_numeric($_POST['number']) && $_POST['number'] >= 0) {
            evenOdd(intval($_POST['number']));
        } else {
            echo "Veuillez entrer un nombre valide.";
        }
    }
    ?>
</body>
</html>
