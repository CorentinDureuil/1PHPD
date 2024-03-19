<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
</head>

<body>
<div id="content">
    <?php
    include('../private/shared/header.php');
    include('../private/shared/redirects/redirect_connected.php');

    if(isset($_SESSION['error']) && $_SESSION['error'] == 'login_error') {
        echo '<p id="error">Mail et/ou mot de passe incorrects. Veuillez réessayer</p>';
    }

    include('../private/shared/forms/connexion_form.php');
    ?>

</div>


</body>
</html>
