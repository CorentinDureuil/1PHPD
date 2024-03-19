<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Compte</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    echo '<div id="account-buttonsContainer">';
    if (isset($_SESSION['account']) && @$_SESSION['account'] != null) {
        echo '<h1>Bienvenue ' . $_SESSION['account'] . '</h1>';
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            echo '<button onclick="window.location.href=' . "'http://localhost/2PHPD_project/public/unfinished_orders.php'" . ';">
                    Voir ou modifier les commandes non terminées
                  </button>';
            echo '<button onclick="window.location.href=' . "'http://localhost/2PHPD_project/public/orders_list.php'" . ';">
                    Rechercher une ou plusieurs commandes
                  </button>';
            echo '<button onclick="window.location.href=' . "'http://localhost/2PHPD_project/public/users_list.php'" . ';">
                    Voir tous les utilisateurs
                  </button>';
            echo '<button onclick="window.location.href=' . "'http://localhost/2PHPD_project/public/search_users.php'" . ';">
                    Rechercher un ou plusieurs utilisateurs
                  </button>';
        } else {
            echo '<button onclick="window.location.href=' . "'http://localhost/2PHPD_project/public/orders_history.php'" . ';">
                    Voir vos commandes
                  </button>';
        }
        include('../private/shared/connected_page.php');

    } else {
        if (isset($_SESSION['created']) && $_SESSION['created'] == 'yes') {
            echo '<p>Votre compte a bien été créé, vous pouvez désormais vous connecter</p>';
        }
        include('../private/shared/disconnected_page.php');
    }
    echo '</div>';
    ?>
</div>


</body>
</html>
