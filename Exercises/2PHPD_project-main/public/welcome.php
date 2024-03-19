<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Page d'accueil</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');

    ?>

    <div id="home-description">
        <h1>Bonjour et bienvenue sur JeansStore</h1>
    </div>
    <div id="page_title">
        <h1>Nos nouveautés</h1>
    </div>
    <div id="articlesContainer">
        <?php
            getNewProducts();
        ?>
    </div>
</div>

<div id="products">

</div>


</body>
</html>