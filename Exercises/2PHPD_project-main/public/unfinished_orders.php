<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Gestion des commandes non terminées</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');
    include('../private/shared/redirects/redirect_noadmin.php');

    echo '<div id="page_title"><h1>Liste des commandes non terminées</h1></div>';
    getUnfinishedOrders();
    ?>
</div>


</body>
</html>
