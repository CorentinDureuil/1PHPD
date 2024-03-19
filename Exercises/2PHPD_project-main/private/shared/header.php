<?php
session_start();
?>

<header>
    <ul>
        <li><a href="../public/welcome.php"><img id="logo" src="../public/images/logo.png" alt="Logo du site JeansStore"/></a></li>
        <li id="onglet"><a href="../public/products.php" class="link">Produits</a></li>
        <li id="onglet"><a href="../public/categories.php" class="link">Catégories</a></li>
        <li id="onglet"><a href="../public/search_products.php" class="link">Rechercher</a></li>

        <li id="onglet"><a href="../public/account.php" class="link"><?php
                if(isset($_SESSION['account'])) {
                    echo 'Mon compte: ' . $_SESSION['account'];
                } else {echo 'Inscription / Connexion';}?></a></li>
        <li id="onglet"><a href="../public/cart.php" class="link">Panier</a></li>
    </ul>
</header>
