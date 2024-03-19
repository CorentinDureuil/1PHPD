<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Commande validée</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="styles/styles.css">
</head>

<body>
<div id="content">
    <header>
        <ul>
            <li><a href="welcome.php"><img id="logo" src="images/logo.png" alt="Logo du site JeansStore"/></a></li>
            <li id="onglet"><a href="products.php" class="link">Produits</a></li>
            <li id="onglet"><a href="categories.php" class="link">Catégories</a></li>
            <li id="onglet"><a href="search_products.php" class="link">Rechercher</a></li>

            <li id="onglet"><a href="account.php" class="link"><?php
                    if(isset($_SESSION['account'])) {
                        echo 'Mon compte: ' . $_SESSION['account'];
                    } else {echo 'Inscription / Connexion';}?></a></li>
            <li id="onglet"><a href="cart.php" class="link">Panier</a></li>
        </ul>
    </header>

    <h1 id="page_title">Votre commande a été validée ! Merci de votre achat</h1>
    <div id="account-buttonsContainer">
        <?php
        echo '<button onclick="window.location.href=' . "'welcome.php'" . ';">
            Retourner à l\'accueil
          </button>'
        ?>
    </div>

</div>

</body>

</html>