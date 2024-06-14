<?php
function afficherInformations($row)
{
    echo '<div class="affichage-info">
                <div class="success"> Connecté !!<br></div>
                <form method="post">
                    <table border="1">
                        <tr><th>Nom</th><td>' . $row['NOM'] . '</td><td><button type="submit" name="modifier" value="Nom">Modifier</button></td></tr>
                        <tr><th>Prénom</th><td>' . $row['PRENOM'] . '</td><td><button type="submit" name="modifier" value="Prenom">Modifier</button></td></tr>
                        <tr><th>Date de naissance</th><td>' . $row['DATE_DE_NAISSANCE'] . '</td><td><button type="submit" name="modifier" value="Date_De_Naissance">Modifier</button></td></tr>
                        <tr><th>Nationalité</th><td>' . $row['NATIONNALITE'] . '</td><td><button type="submit" name="modifier" value="Nationnalite">Modifier</button></td></tr>
                        <tr><th>Identifiant</th><td>' . $row['ID_PARTICIPANT'] . '</td><td><input type="hidden"value="Id_Participant"></td></tr> 
                        <tr><th>Num de membre du comite</th><td>' . $row['NUM_MEMBRES_COMITE'] . '</td><td><input type="hidden" value="Num_Membres_Comite"</td></tr>                 
                        <tr><th>Mot de passe </th><td>*************</td><td><button type="submit" name="modifier" value="Mot_De_Passe">Modifier</button></td></tr> 
                    </table>
                    <input type="hidden" name="Identifiant" value="' . $row["ID_PARTICIPANT"] . '">
                    <input type="hidden" name="password" value="' . $row["MOT_DE_PASSE"] . '">
                    <input type="hidden" name="Num_Membres_Comite" value="' . $row['NUM_MEMBRES_COMITE'] . '">
                    <ul>
                        <li><input type="submit" name="logout" id="logout" value="Déconnexion"></li>
                        <li><input type="submit" name="delete" value="Delete my count" id="delete"></li>
                    <ul>
                </form>
        </div>
    ';
}

function afficherModificationForm($champ_modifie, $Identifiant, $password)
{
    echo '<div class="affichage-modification">';
    echo '<form method="post">';

        echo '<input type="hidden" name="Identifiant" value="' . $Identifiant . '">';
        echo '<input type="hidden" name="password" value="' . $password . '">';
        echo '<input type="hidden" name="champ_modifie" value="' . $champ_modifie . '">';

        echo '<label for="modification">Nouv ' . $champ_modifie . ' : </label>';
        if ($champ_modifie == "Mot_De_Passe") {
            echo '<input type="password" id="modification" name="modification" required>';
        }elseif($champ_modifie == "Date_De_Naissance"){
            echo '<input type="date" id="modification" name="modification" required>';
        }else{
            echo '<input type="text" id="modification" name="modification" required>';
        }
        echo '<br><input type="submit" name="valider_modification" value="Valider">';
    echo '</form>';
    echo '</div>';
}
?>