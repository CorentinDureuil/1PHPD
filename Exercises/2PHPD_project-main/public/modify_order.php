<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Modification de commande</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');
    include('../private/shared/redirects/redirect_noadmin.php');

    if(!isset($_GET['order_id'])) {
        header('location: ../public/unfinished_orders.php');
    } else {
        modifyOrder($_GET['order_id']);
    }
    ?>

</div>

</body>

</html>