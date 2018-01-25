<?php
/**
 * Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 25/01/18
 * Time: 11:51
 * Version 0.1
 * CRUD_display.php contient une variable utilisée par crud_interface() pour afficher l'interface
 * de base de l'administrateur.
 * TODO : A déplacer dans un autre fichier  --> pas clair
 */

$crud_form_1='<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ADMIN</title>
    </head>
    <body>

    <fieldset>
        <legend>Administration</legend>
        <form id="admin_01" action="index.php" method="post">
            <label for="afficher">Afficher les informations relatives aux :</label>
            <br/><br/>
            <input type="radio" id="operateurs" name="afficher" value="1"><label>Opérateurs</label>
            <br/>
            <input type="radio" id="gestionnaires" name="afficher" value="2"><label>Gestionnaires</label>
            <br/>
            <input type="radio" id="administrateurs" name="afficher" value="3"><label>Administrateurs</label>
            <p><input id="query_name" type="submit" value="AFFICHER"></p>
        </form>

    </fieldset>

    </body>
</html>';