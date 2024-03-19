<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Détails de la commande n° <?php echo $_POST['order_id']?></title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include ('../private/functions.php');

    if (isset($_POST['order_id'])) {
        echo '<div id="page_title"><h1>Détails de la commande n°' . $_POST['order_id'] . '</h1></div>';
        getOrder($_POST['order_id']);
    } else {
        header("location: orders_history.php");
    }

    ?>

    <div id="categories">

    </div>

</div>


</body>
</html>