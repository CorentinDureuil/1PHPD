<div id="form">
    <form action="../private/functions.php" method="post">

        <label for="first_name">Prénom : </label>
        <input type="text" id="first_name" name="first_name" placeholder="Prénom" required>

        <br/><br/>

        <label for="last_name">Nom de famille : </label>
        <input type="text" id="last_name" name="last_name" placeholder="Nom de famille" required>

        <br/><br/>

        <label for="mail">Mail : </label>
        <input type="email" id="mail" name="mail" placeholder="Mail" required>

        <br/><br/>

        <label for="password">Mot de passe (8 caractères minimum) : </label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" minlength="8" required>

        <br/><br/>

        <label for="verify-password">Confirmation du mot de passe : </label>
        <input type="password" id="verify-password" name="verify-password" placeholder="Confirmation du mot de passe" required>

        <br/><br/><br/><br/>

        <label for="billing_address">Adresse de facturation : </label>
        <input type="text" id="billing_address" name="billing_address" placeholder="Adresse de facturation" required>
        <br/><i>(exemple: 144 rue Nationale)</i>

        <br/><br/>

        <label for="billing_city">Ville de facturation : </label>
        <input type="text" id="billing_city" name="billing_city" placeholder="Ville de facturation" required>
        <br/><i>(exemple: 59000 Lille)</i>

        <br/><br/>

        <label for="delivery_address">Adresse de livraison : </label>
        <input type="text" id="delivery_address" name="delivery_address" placeholder="Adresse de livraison" required>
        <br/><i>(exemple: 144 rue Nationale)</i>

        <br/><br/>

        <label for="delivery_city">Ville de livraison : </label>
        <input type="text" id="delivery_city" name="delivery_city" placeholder="Ville de livraison" required>
        <br/><i>(exemple: 59000 Lille)</i>

        <br/><br/>

        <button id="buttonForm" name="createUser">Créer un utilisateur</button>

    </form>
</div>