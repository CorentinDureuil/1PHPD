<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grade = $_POST['grade'];

    switch (true) {
        case $grade >= 0 && $grade < 10:
            echo "NUL";
            break;
        case $grade >= 10 && $grade < 12:
            echo "BOF";
            break;
        case $grade >= 12 && $grade < 14:
            echo "TU PEUX MIEUX FAIRE";
            break;
        case $grade >= 14 && $grade < 16:
            echo "OUAIS PAS MAL";
            break;
        case $grade >= 16 && $grade < 18:
            echo "WOW";
            break;
        case $grade >= 18 && $grade <= 20:
            echo "OK T'ES UN TRICHEUR";
            break;
        default:
            echo "Note invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Vérification de note</title>
</head>
<body>

<form action="Ex02.php" method="post">
    <label for="grade">Entrez votre note:</label>
    <input type="number" id="grade" name="grade" required>
    <input type="submit" value="Vérifier">
</form>

</body>
</html>
