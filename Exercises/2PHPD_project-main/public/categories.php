<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Catégories</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include ('../private/functions.php');
    ?>
    <h1 id="page_title">Toutes nos catégories</h1>
    <div id="categories">
        <?php getCategories(); ?>
    </div>

</div>


</body>
</html>