<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrator-Profile</title>
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../Css/nav-style.Css"/>
        <link rel="stylesheet" type="text/css" href="../css/connexion-page-style.css"/>

</head>
<body>

    <!-- Navigation-->
    <div class="body-container">
            <nav class="navigation-container">
                <div class="Titre">
                    <a href="index.html">Olympic Games Paris 2024</a>
                </div>
                <div class="logo">
                    <img src="../images/logo.png" alt="Logo">
                </div>
                <div class="barnav">
                    <ul>
                        <li><a href="http://localhost/mon_site/index.html">Home</a></li>
                        <li><a href="http://localhost/mon_site/windows/Administrator.php">Administrator</a></li>
                        <li><a href="http://localhost/mon_site/windows/Visitor.html">Visitor</a></li>
                        <li><a href="http://localhost/mon_site/windows/Contact.html">Contact</a></li>
                        <li><a href="http://localhost/mon_site/windows/About.html">About</a></li>
                        <form>
                            <input type="search" id="search" name="search">
                            <input type="submit" id="research" name="research" value="research">
                        </form>
                    </ul>
                </div>
            </nav>  

        <div class="connexion-head-container">
    <?php

    include("../connexion-base/connex.inc.php");
    include("../functions/functions.php");

    if (isset($_POST['submit'])) {

        $Identifiant = $_POST['Identifiant'];
        $password = $_POST['password'];
        $idcom = connex("olympicsports2024", "my-param");

        $requete_connexion = "SELECT * FROM Participants,Membres_De_Comite WHERE Participants.Id_Participant = Membres_De_Comite.Id_Participant and Membres_De_Comite.Id_Participant = ? AND Membres_De_Comite.Mot_De_Passe = ?";
    
        $stmt = mysqli_prepare($idcom, $requete_connexion);
        mysqli_stmt_bind_param($stmt, "ss", $Identifiant, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            afficherInformations($row);
            
            mysqli_stmt_close($stmt);
            mysqli_close($idcom);

        } else {
            echo "<div class='error'>Mot de passe ou identifiant incorrect !!<br></div>";
        }
    }

    if (isset($_POST["modifier"])) {

        $champ_modifie = $_POST['modifier'];
        $Identifiant = $_POST['Identifiant'];
        $password = $_POST['password'];

        afficherModificationForm($champ_modifie, $Identifiant, $password);

    }

    if (isset($_POST["valider_modification"]) && !empty($_POST["modification"])) {

        $nouvelle_val = $_POST["modification"];
        $champ_modifie = $_POST['champ_modifie'];

        $Identifiant = $_POST['Identifiant'];
        $password = $_POST['password'];

        $idcom = connex("olympicsports2024", "my-param");


        if($champ_modifie == "Mot_De_Passe"){

            $requete_update_membres = "UPDATE Membres_De_Comite SET $champ_modifie = ? WHERE Mot_De_Passe = ? and Id_Participant = ? ";
            $stmt_update_membres = mysqli_prepare($idcom, $requete_update_membres);
            mysqli_stmt_bind_param($stmt_update_membres, "sss", $nouvelle_val, $password, $Identifiant);
            mysqli_stmt_execute($stmt_update_membres);
        }else{
            $requete_update_participants = "UPDATE Participants SET $champ_modifie = ? WHERE Id_Participant = ?";
            $stmt_update_participants = mysqli_prepare($idcom, $requete_update_participants);
            mysqli_stmt_bind_param($stmt_update_participants, "ss", $nouvelle_val, $Identifiant);
            mysqli_stmt_execute($stmt_update_participants);
        }

        
        $requete_connexion = "SELECT * FROM Participants,Membres_De_Comite WHERE Participants.Id_Participant = Membres_De_Comite.Id_Participant and Membres_De_Comite.Id_Participant = ? AND Membres_De_Comite.Mot_De_Passe = ?";
    
        $stmt = mysqli_prepare($idcom, $requete_connexion);
        mysqli_stmt_bind_param($stmt, "ss", $Identifiant, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        afficherInformations($row);
        mysqli_stmt_close($stmt);
        mysqli_close($idcom);
    }
    ?>
    
    <?php
        if (isset($_POST["logout"])) {
            $_POST = array();
            header("Location: Administrator.php");
            exit();
        }
    ?>

    
    <?php
        if (isset($_POST["delete"])) {
            $idcom = connex("olympicsports2024", "my-param");

            $Identifiant = $_POST['Identifiant'];
            $nb_del = $_POST['Num_Membres_Comite'];

            $requete_delete_1 = "DELETE FROM Membres_De_Comite WHERE Membres_De_Comite.Num_Membres_Comite = ?";
            $stmt_delete_1 = mysqli_prepare($idcom, $requete_delete_1);
            mysqli_stmt_bind_param($stmt_delete_1, "s", $nb_del);
            mysqli_stmt_execute($stmt_delete_1);
            $rows_1 = mysqli_stmt_affected_rows($stmt_delete_1);
        
            $requete_delete_2 = "DELETE FROM Participants WHERE Participants.Id_Participant = ?";
            $stmt_delete_2 = mysqli_prepare($idcom, $requete_delete_2);
            mysqli_stmt_bind_param($stmt_delete_2, "s", $Identifiant);
            mysqli_stmt_execute($stmt_delete_2);
            $rows_2 = mysqli_stmt_affected_rows($stmt_delete_2);
        
            if ($rows_1 > 0 && $rows_2 > 0) {
                echo '<div class="success">Compte supprimé avec succès.</div>';
            } else {
                echo "<div class='error'>Une erreur s'est produite lors de la suppression. Veuillez réessayer.</div>";
            }
        
            mysqli_stmt_close($stmt_delete_1);
            mysqli_stmt_close($stmt_delete_2);
            mysqli_close($idcom);
        }
    ?>
    <div class="retour">
        <button onclick="window.history.back()">Retour</button>
    </div>
</body>
</html>