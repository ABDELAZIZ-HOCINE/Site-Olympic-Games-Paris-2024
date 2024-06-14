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
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="Administrator.php">Administrator</a></li>
                    <li><a href="Visitor.html">Visitor</a></li>
                    <li><a href="Contact.html">Contact</a></li>
                    <li><a href="About.html">About</a></li>

                    <form>
                        <input type="search" id="search" name="search">
                        <input type="submit" id="research" name="research" value="research">
                    </form>
                </ul>
            </div>
        </nav>
    <div class="inscription-head-container">
        <?php
            if (isset($_POST["submit"])) {

                if (isset($_POST['Identifiant']) && isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['Date_De_Naissance']) && isset($_POST['Nationnalite']) && isset($_POST['password']) && $_POST['password'] == $_POST['password-confirm']){

                    include("../connexion-base/connex.inc.php");
              
                    $Id_Participant = $_POST['Identifiant'];
                    $Mot_De_Passe = $_POST['password'];
                    $Nom = $_POST['Nom'];
                    $Prenom = $_POST['Prenom'];
                    $Date_De_Naissance = $_POST['Date_De_Naissance'];
                    $Nationnalite = $_POST['Nationnalite'];

                    $conn = connect("my-param");

                    $requete_verif = "SELECT Id_Participant FROM Participants WHERE Id_Participant = $Id_Participant";
                    
                    $stid_verif = oci_parse($conn, $requete_verif);
                    oci_execute($stid_verif);
                    $row = oci_fetch_row($stid_verif);

                    if ($row > 0 ) {
                        var_dump($row);
                        echo "<div class='error'>L'identifiant est déjà utilisé. Veuillez en choisir un autre.</div>";
                    } else {
                        $requete_dernier_num = "SELECT MAX(Num_Membres_Comite) AS dernier_num FROM Membres_De_Comite";
                        $stid_dernier_num = oci_parse($conn, $requete_dernier_num);
                        oci_execute($stid_dernier_num);
                        
                        $row_dernier_num = oci_fetch_assoc($stid_dernier_num);
                        
                        if ($row_dernier_num) {
                            $dernier_num = $row_dernier_num['DERNIER_NUM'];
                            $Num_Membres_Comite = $dernier_num + 1;
                        }

                        $requete_insert_1 = "INSERT INTO Participants (Id_Participant, Nom, Prenom, Date_De_Naissance, Nationnalite) VALUES ($Id_Participant, '$Nom', '$Prenom',TO_DATE('$Date_De_Naissance','YYYY-mm-dd'), '$Nationnalite')";
                        $requete_insert_2 = "INSERT INTO Membres_De_Comite (Num_Membres_Comite, Mot_De_Passe, Id_Participant) VALUES ($Num_Membres_Comite, '$Mot_De_Passe', $Id_Participant)";

                        $stid_insert_1 = oci_parse($conn, $requete_insert_1);
                        $result_1 = oci_execute($stid_insert_1);

                        $stid_insert_2 = oci_parse($conn, $requete_insert_2);
                        $result_2 = oci_execute($stid_insert_2);                        

                        if (  $result_1 &&  $result_2 ) {
                            echo '
                                <div class="success">Inscription réussie. Vous pouvez maintenant vous connecter.</div>
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
                            echo "<div class='error'>Une erreur s'est produite lors de l'inscription. Veuillez réessayer.</div>";
                        }

                        $requete_v = "commit";
                        $stid_v = oci_parse($conn, $requete_v);
                        oci_execute($stid_v);

                        oci_free_statement($stid_v);
                        oci_free_statement($stid_dernier_num);
                        oci_free_statement($stid_insert_1);
                        oci_free_statement($stid_insert_2);
                    }
                    oci_free_statement($stid_verif);
                    oci_close($conn);

                } else {
                    echo "<div class='error'>Veuillez remplir bien tous les champs du formulaire d'inscription.</div>";
                }
            }
        ?>

        <div class="retour">
            <button onclick="window.history.back()" >Retour</button>
        </div>

    </div>
</div>
</body>
</html>