<?php
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 20/11/15
 * Time: 19:09
 */
?>

<form method="post" action="index.php?controller=visiteur&action=created">
    <legend>Inscription</legend>
    <fieldset>
        <label for="login" class="label"  >login</label>
        <input type="text"  name="login" required/><p></p>
        <label for="nom" class="label">nom</label>
        <input type="text"  name="nom"/><p></p>
        <label for="prenom" class="label">prenom</label>
        <input type="text"  name="prenom"/><p></p>

        <label for="email" id="label">  email</label>
        <input type="email" placeholder="Ex: alice.toirdrol@boiteAcamembert.fr" name="email" id="email"
                /><p></p>

        <label for="sexe" id="label">sexe</label>
        <input type="radio" name="sexe" value="homme" id="homme" />
            <label for="homme">H </label>
        <input type="radio" name="sexe" value="femme" id="femmme" required/>
            <label for="femme">F</label><p></p>

        <label for="mdp" id="label">mot de passe</label>
        <input type="password"  name="mdp" id="mdp"  required /><p></p>

        <label for="mdp2" id="label">valider mot de passe</label>
        <input type="password" name="mdp2" id="mdp2" required/><p></p>

        <input type="submit" value="Inscription" /> </p>

    </fieldset>
</form>
