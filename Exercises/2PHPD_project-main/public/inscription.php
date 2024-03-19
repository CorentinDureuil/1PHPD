<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    require('../private/shared/redirects/redirect_connected.php');

    if (isset($_SESSION['error'])) {
        if ($_SESSION['error'] == "incorrect_password") {
            echo '<p id="error">Les mots de passe renseignés sont différents. Veuillez réessayer</p>';
        }
        elseif ($_SESSION['error'] == "used_mail") {
            echo '<p id="error">Le mail que vous avez renseigné est déjà utilisé. Veuillez réessayer</p>';
        }
    }

    include('../private/shared/forms/inscription_form.php');
    ?>

</div>

</body>

</html>