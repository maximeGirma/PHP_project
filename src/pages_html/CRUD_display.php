<?php
$crud_form_1='<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ADMIN</title>
    </head>
    <body>

    <fieldset>
        <legend>ADMIN</legend>
        <form action="CRUD_interface.php" method="post">
            <label for="afficher">Afficher les informations relatives aux:</label>
            <br/>
            <input type="radio" id="operateurs" name="afficher" value="1"><label>Opérateurs</label>
            <br/>
            <input type="radio" id="gestionnaires" name="afficher" value="2"><label>Gestionnaires</label>
            <br/>
            <input type="radio" id="administrateurs" name="afficher" value="3"><label>Administrateurs</label>
            <p><input type="submit" value="envoyer"></p>
        </form>

    </fieldset>

    </body>
</html>';