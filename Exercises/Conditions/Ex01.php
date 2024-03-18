<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST['age'];
    echo ($age >= 18) ? "Bienvenue ! L'accès est autorisé." : "Accès refusé. Vous devez avoir plus de 18 ans.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vérification de l'âge</title>
</head>
<body>

<form action="Ex01.php" method="post">
    <label for="age">Entrez votre âge:</label>
    <input type="number" id="age" name="age" required>
    <input type="submit" value="Vérifier">
</form>

</body>
</html>
