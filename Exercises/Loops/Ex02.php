<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FizzBuzz Game</title>
</head>
<body>
    <form method="post">
        <label for="number">Limite:</label>
        <input type="number" id="number" name="number" required>
        <button type="submit">Lancer</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['number']) && is_numeric($_POST['number']) && $_POST['number'] >= 0) {
            $X = intval($_POST['number']);
            for ($i = 0; $i <= $X; $i++) {
                if ($i % 3 == 0 && $i % 5 == 0) {
                    echo "FizzBuzz<br>";
                } elseif ($i % 3 == 0) {
                    echo "Fizz<br>";
                } elseif ($i % 5 == 0) {
                    echo "Buzz<br>";
                } else {
                    echo $i . "<br>";
                }
            }
        } else {
            echo "Veuillez entrer un nombre valide.";
        }
    }
    ?>
</body>
</html>
