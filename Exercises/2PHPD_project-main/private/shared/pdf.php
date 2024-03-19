<?php
include('../functions.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Détails de la commande n°<?php echo $_GET['order_id'];?></title>
    <link rel="stylesheet" type="text/css" href="http://localhost/2PHPD_project/public/styles/pdf-styles.css"/>
</head>

<body>
<div id="content">
    <div id="logo">
        <img id="logo" src="http://localhost/2PHPD_project/public/images/logo.png" alt="Logo du site JeansStore"/>
    </div>
    <div id="order_id">
        <h1>Commande n°<?php echo $_GET['order_id'];?></h1>
        <p>Date de commande: <?php getOrderDate($_GET['order_id']);?></p>
    </div>
    <div id="user_infos">
        <?php getUserInfos($_GET['order_id']);?>
    </div>
    <div id="table">
        <?php getOrder($_GET['order_id']); ?>
    </div>

</div>


</body>
</html>
