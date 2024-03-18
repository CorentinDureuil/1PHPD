<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Syntax - Exercise 1</title>
</head>
<body>
    <?php
        $firstName = "Corentin";
        $lastName = "DUREUIL";
        $age = 21;
        $size = 1.98;
        $zipCode = "59300";

        echo "Je me présente: $firstName $lastName. <br>";
        echo "J'ai $age ans. <br>";
        echo "Je mesure $size m. <br>";
    ?>
    <button onclick="displayZipCode(<?php echo $zipCode; ?>)">Display Zip Code</button>
</body>
</html>

<script>
    function displayZipCode(zipCode) {
        alert("Mon code postal est: " + zipCode);
    }
</script>
