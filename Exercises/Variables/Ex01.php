<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Syntax - Exercise 1</title>
</head>
<body>
    <?php
        require_once '../Classes/Person.php';
        use Classes\Person;

        $person = new Person("Corentin", "DUREUIL", 21, 1.98, "59300");
        $person->displayInformation();
    ?>
</body>
</html>
