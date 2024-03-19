<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hashPassword'])) {
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_BCRYPT);
    }

    if (isset($_POST['verifyPassword'])) {
        $password = $_POST['password'];
        $storedHash = $_POST['hash'];

        $isPasswordCorrect = password_verify($password, $storedHash);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hasher et vérifier un mot de passe</title>
</head>
<body>
    <h2>Hasher un mot de passe</h2>
    <form method="post">
        <label for="password">Mot de passe :</label>
        <input type="text" id="password" name="password" required>
        <button type="submit" name="hashPassword">Hasher le mot de passe</button>
    </form>
    <?php
        if (isset($hash)) {
            echo "<p>Hash du mot de passe: $hash</p>";
        }
    ?>

    <h2>Vérifier un mot de passe</h2>
    <form method="post">
        <label for="password">Mot de passe :</label>
        <input type="text" id="password" name="password" required>
        <label for="hash">Hash :</label>
        <input type="text" id="hash" name="hash" required>
        <button type="submit" name="verifyPassword">Vérifier le mot de passe</button>
    </form>
    <?php
        if (isset($isPasswordCorrect)) {
            if ($isPasswordCorrect) {
                echo "<p>Le mot de passe est correct !</p>";
            } else {
                echo "<p>Le mot de passe est invalide.</p>";
            }
        }
    ?>
</body>
</html>
