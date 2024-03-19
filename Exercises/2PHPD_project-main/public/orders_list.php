<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Toutes les commandes</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');
    include('../private/shared/redirects/redirect_noadmin.php');

    echo '<div id="searchBar">
            <label for="search_order">Rechercher une ou plusieures commandes n° :</label>
            <input type="number" min="1" class="form-control" name="formCategory" placeholder="Search" id="search_order"/>
          </div>
    <div id="orderResult"></div>'
    ?>
</div>

<script  type="text/javascript" src="../private/scripts/search_orders/ajax.js"></script>
</body>
</html>
