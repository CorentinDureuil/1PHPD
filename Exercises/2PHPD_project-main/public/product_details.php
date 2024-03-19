<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title><?php echo $_GET['name'] ?></title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include ('../private/functions.php');
    echo '<div id="productContainer">';
    if (isset($_GET['name']) && isset($_GET['id'])) {
        getProduct($_GET['id']);
    } else {
        header("location: products.php");
    }
    echo '</div>'

    ?>

    <div id="categories">

    </div>

</div>


</body>
</html>