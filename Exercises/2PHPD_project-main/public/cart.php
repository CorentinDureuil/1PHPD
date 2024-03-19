<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Panier</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');
    echo '<div id="display_state_cart">';
    if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        echo '<h1>Pas de produits ajoutés à votre panier</h1>';
        echo '</div>';
    } else {
        echo '<h1>Votre panier</h1>';
        if (isset($_SESSION['account'])) {
            echo '<button onclick="window.location.href=' . "'http://localhost/2PHPD_project/public/payment.php'" . ';">Procéder au paiement</button>';
        } else {
            echo '<button onclick="window.location.href=' . "'http://localhost/2PHPD_project/public/account.php'" . ';">
                    Se connecter pour procéder au paiement
                  </button>';
        }
        echo '</div>';
        displayCart();
    }

    ?>

</div>

</body>

</html>