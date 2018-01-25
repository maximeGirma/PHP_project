<?php
/**
 * Created by IntelliJ IDEA.
 * Author: MaximeGirma, GeoffroyAmiard, PeterBocquenet, KomlaganTeckou
 * Date: 19/01/18
 * Time: 11:26
 * Version 0.9
 * crud_display_update_interface() est appelé par le crud_interface() et permet l'affichage
 * de l'interface de modification d'un utilisateur précis. Le choix de l'utilisateur à modifier
 * est renseigné par l'administrateur via un $_POST['modifier'], la fonction va chercher dans la bdd
 * les données de l'utilisateur renseigné
 * Puis elle retourne le str correspondant à l'interface à afficher.
 *
 *
 * crud_update() est appelé par crud_interface(), elle met à jour les données de la bdd avec les données
 * renseignées par l'administrateur dans le crud_display_update_interface().
 * Renvoit un str pour signaler la reussite ou l'echec de la requete.
 */

function crud_display_update_interface(){

    $display_query_update = "    
            SELECT 
            `id_utilisateur`,`nom_utilisateur`,`prenom_utilisateur` 
            FROM
            utilisateur
            WHERE id_utilisateur =";

    $modifier = $_POST['modifier'];

    if ($statement = bdd_acces($display_query_update . $modifier . ';')) {

        //$string_to_return = display_query_result($statement);
        $string_to_return ="";
        $statement->execute();
        $item = $statement->fetchObject();

        $string_to_return.= '<form id="user_edit" action="index.php" method="post">
                <label for="nom">nom : </label>
                <input name="nom" type="text" required value="' . $item->nom_utilisateur . '"><br/>
                <label for="prenom">prenom : </label>
                <input name="prenom" type="text" required value="' . $item->prenom_utilisateur . '"><br/>
                
                <label for="new_ID">nouveau login: </label>
                <input name="new_ID" type="text" required><br/>
                <label for="new_PSW">nouveau mot de passe: </label>
                <input name="new_PSW" type="password" required><br/>
                <label for="id_type_user"><b>type d\'utilisateur :</b></label>
                <br/>
                <input type="radio"  name="id_type_user" value="1"><label>Opérateurs</label>
                <br/>
                <input type="radio"  name="id_type_user" value="2"><label>Gestionnaires</label>
                <br/>
                <input type="radio"  name="id_type_user" value="3"><label>Administrateurs</label>
                <input name="update" type="hidden" value = "1">
                <input name="id_utilisateur" type="hidden" value = "' . $item->id_utilisateur . '"><br/>
                <input type="submit" value="Modifier">
                </form>
                <form action="index.php" method="post">
                <input name="delete" type="hidden" value = "1">
                <input name="id_utilisateur" type="hidden" value = "' . $item->id_utilisateur . '">
                <input id="query_name" type="submit" value="supprimer utilisateur">
                </form>';

                return $string_to_return;
    }


}

function crud_update(){

    $update_query = '
    UPDATE 
      `utilisateur` 
    SET 
      `nom_utilisateur`= \'' . $_POST['nom'] . '\',
      `prenom_utilisateur`= \'' . $_POST['prenom'] . '\',
      `login`= \'' . $_POST['new_ID'] . '\',
      `password_utilisateur`= \'' . $_POST['new_PSW'] . '\',
      `id_type_utilisateur`= \'' . $_POST['id_type_user'] . '\' 
    WHERE 
      `id_utilisateur`= \'' . $_POST['id_utilisateur'] . '\';';

    if ($statement = bdd_acces($update_query)) {

        return '<p>modification effectuée !</p>';


    } else return 'ERREUR : La modification n\'a pas pu etre effectuée';
}

