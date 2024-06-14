<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrator-Profile</title>
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../Css/nav-style.Css"/>
        <link rel="stylesheet" type="text/css" href="../css/connexion-page-style.css"/>
        <link rel="stylesheet" type="text/css" href="../css/inscription-page-style.css"/>
        <link rel="stylesheet" type="text/css" href="../Css/style_Adminisrator.Css"/>

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
                        <li><a href="index.html">Home</a></li>
                        <li><a href="windows/Administrator.php">Administrator</a></li>
                        <li><a href="windows/Visitor.html">Visitor</a></li>
                        <li><a href="windows/Contact.html">Contact</a></li>
                        <li><a href="windows/About.html">About</a></li>
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

    if (isset($_POST['submit'])){
        if(is_numeric($_POST['Identifiant']) ) {

            $Identifiant = $_POST['Identifiant'];
            $password = $_POST['password'];
            $conn = connect("my-param");
            $requete_connexion = "SELECT * FROM Participants,Membres_De_Comite WHERE Participants.Id_Participant = Membres_De_Comite.Id_Participant and Membres_De_Comite.Id_Participant = $Identifiant AND Membres_De_Comite.Mot_De_Passe = '$password'";
            $stid = oci_parse($conn, $requete_connexion);
            oci_execute($stid);
            $row = oci_fetch_array($stid);
            if ($row > 0) {
                afficherInformations($row);
                oci_free_statement($stid);
                oci_close($conn);
            } else {
                echo "<div class='error'>Mot de passe ou identifiant incorrect !!<br></div>";
            }
        }else{
            echo "<div class='error'>L'identifiant doit contenir uniquement des chiffres !!<br></div>";
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

        $conn = connect("my-param");

        if($champ_modifie == "Mot_De_Passe"){

            $requete_update_membres = "UPDATE Membres_De_Comite SET $champ_modifie = '$nouvelle_val' WHERE Mot_De_Passe = '$password' and Id_Participant = $Identifiant ";
            $stid_update_membres = oci_parse($conn, $requete_update_membres);
            oci_execute($stid_update_membres);
        }elseif($champ_modifie == "Date_De_Naissance"){
            $requete_update_participants = "UPDATE Participants SET $champ_modifie = TO_DATE('$nouvelle_val', 'YYYY-mm-dd') WHERE Id_Participant = $Identifiant";
            $stid_update_participants = oci_parse($conn, $requete_update_participants);
            oci_execute($stid_update_participants);
        }else{
            $requete_update_participants = "UPDATE Participants SET $champ_modifie = '$nouvelle_val' WHERE Id_Participant = $Identifiant";
            $stid_update_participants = oci_parse($conn, $requete_update_participants);
            oci_execute($stid_update_participants);
        }

        $requete_v = "commit";
        $stid_v = oci_parse($conn, $requete_v);
        oci_execute($stid_v);

        $requete_connexion = "SELECT * FROM Participants,Membres_De_Comite WHERE Participants.Id_Participant = Membres_De_Comite.Id_Participant and Membres_De_Comite.Id_Participant = $Identifiant AND Membres_De_Comite.Mot_De_Passe =  '$password'";
    
        $stid = oci_parse($conn, $requete_connexion);
        oci_execute($stid);
        $row = oci_fetch_array($stid);
        afficherInformations($row);
        oci_free_statement($stid);
        oci_close($conn);
    }
    ?>

    <?php
        if (isset($_POST["logout"])) {
            $_POST = array();
            echo '<script>window.location.href = "http://localhost/mon_site_2/windows/Administrator.php";</script>';
            exit();
        }
    ?>
    
    <?php
        if (isset($_POST["delete"])) {

            $conn = connect("my-param");

            $Identifiant = $_POST['Identifiant'];
            $num_mbr = $_POST['Num_Membres_Comite'];

            $requete_delete_1 = "DELETE FROM Membres_De_Comite WHERE Membres_De_Comite.Num_Membres_Comite = $num_mbr";
            $stid_delete_1 = oci_parse($conn, $requete_delete_1);
            $result_1 = oci_execute($stid_delete_1);
         
            $requete_delete_2 = "DELETE FROM Participants WHERE Participants.Id_Participant = $Identifiant";
            $stid_delete_2 = oci_parse($conn, $requete_delete_2);
            $result_2 = oci_execute($stid_delete_2);

            $requete_v = "commit";
            $stid_v = oci_parse($conn, $requete_v);
            oci_execute($stid_v);
        
            if ($result_1 && $result_2) {
                echo '<div class="success">Compte supprimé avec succès.</div>';
                echo '
                <form method="post" action="Administrator.php">
                    <div class="link-connexion-inscription">
                        <ul>
                            <li><input type="submit" name="Connexion" value="Connexion"></li>
                            <li><input type="submit" name="Inscription" value="Inscription"></li>
                        </ul>
                    </div>
                </form>
            ';
            } else {
                echo "<div class='error'>Une erreur s'est produite lors de la suppression. Veuillez réessayer.</div>";
            }
        
            oci_free_statement($stid_delete_1);
            oci_free_statement($stid_delete_2);
            oci_close($conn);
            
        }
    ?>
    <div class="retour">
        <button onclick="window.history.back()">Retour</button>
    </div>
</body>
</html>