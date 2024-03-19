<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Paiement</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/functions.php');
    include('../private/shared/redirects/redirect_payment.php');

    echo '<div id="payment_recap">';

    echo '<h1>Paiement</h1>';
    getAddresses();
    echo '<br/><br/><form action="../private/functions.php" method="post"><button name="confirmPayment">Terminer le paiement</button></form>';

    echo '<div/>';

    ?>

</div>

</body>

</html>