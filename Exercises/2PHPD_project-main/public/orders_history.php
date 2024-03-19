<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Historique des commandes</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');

    if(isset($_GET['user_id']) && $_SESSION['admin'] == 1) {
        echo '<div id="page_title"><h1>Commandes de  l\'utilisateur n° ' . $_GET['user_id'] . '</h1></div>';
        getUserOrders($_GET['user_id']);
    } elseif(isset($_SESSION['account_id']) && $_SESSION['admin'] == 0) {
        echo '<div id="page_title"><h1>Vos commandes passées</h1></div>';
        getUserOrders($_SESSION['account_id']);
    } else {
        header('location: welcome.php');
    }


    ?>
</div>


</body>
</html>
