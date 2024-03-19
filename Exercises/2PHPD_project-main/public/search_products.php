<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Recherche de produits</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');

    ?>
    <div id="searchBar">
    <label for="search_id">Rechercher un ou plusieurs produits : </label>
    <input type="text" class="form-control" name="formCategory" placeholder="Search" id="search_id"/>
    </div>
    <div id="txtHint"></div>
</div>

<script  type="text/javascript" src="../private/scripts/search_products/ajax.js"></script>
</body>
</html>