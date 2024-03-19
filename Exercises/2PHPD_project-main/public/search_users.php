<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Rechercher des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/shared/redirects/redirect_noadmin.php');

    echo '<div id="searchBar">
            <label for="search_user">Rechercher un utilisateur ayant pour nom :</label>
            <input type="text" class="form-control" name="formCategory" placeholder="Search" id="search_user"/>
          </div>';
    echo '<div id="usersResult"></div>'
    ?>
</div>

<script  type="text/javascript" src="../private/scripts/search_users/ajax.js"></script>
</body>
</html>
