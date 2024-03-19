<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Tous les utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');
    include('../private/shared/redirects/redirect_noadmin.php');
    addPagination();
    ?>
</div>

<script  type="text/javascript" src="../private/scripts/search_users/ajax.js"></script>
</body>
</html>
