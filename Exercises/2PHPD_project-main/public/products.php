<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <?php
    if(isset($_GET['category'])) {
        echo '<title>Produits '. $_GET['category'] . '</title>';
    } else {
        echo '<title>Produits</title>';
    }
    ?>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include ('../private/functions.php');

    if (isset($_GET['category'])) {
        echo '<h1 id="page_title">Produits de la catégorie ' . $_GET['category'] . '</div>';
        echo '<div id="articlesContainer">';
        getCategoryProducts($_GET['category']);
    } else {
        echo '<h1 id="page_title">Tous nos produits</h1>';
        echo '<div id="articlesContainer">';
        getAllProducts();
    }
    echo '</div>';
    ?>

</div>


</body>
</html>