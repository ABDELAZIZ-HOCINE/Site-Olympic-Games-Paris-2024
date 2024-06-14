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
    <div class="inscription-head-container">
        <?php
            if (isset($_POST["submit"])) {

                if (isset($_POST['Identifiant']) && isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['Date_De_Naissance']) && isset($_POST['Nationnalite']) && isset($_POST['password']) && $_POST['password'] == $_POST['password-confirm']){

                    include("../connexion-base/connex.inc.php");

                    $idcom = connex("olympicsports2024", "my-param");
                
                    $requete_dernier_num = "SELECT MAX(Num_Membres_Comite) AS dernier_num FROM Membres_De_Comite";
                    $result_dernier_num = mysqli_query($idcom, $requete_dernier_num);
                
                    if ($result_dernier_num) {
                        $row_dernier_num = mysqli_fetch_assoc($result_dernier_num);
                        $dernier_num = $row_dernier_num['dernier_num'];
                        $Num_Membres_Comite = $dernier_num + 1;
                    }

                    $Id_Participant = $_POST['Identifiant'];
                    $Mot_De_Passe = $_POST['password'];
                    $Nom = $_POST['Nom'];
                    $Prenom = $_POST['Prenom'];
                    $Date_De_Naissance = $_POST['Date_De_Naissance'];
                    $Nationnalite = $_POST['Nationnalite'];

                    $requete_verif = "SELECT * FROM Participants WHERE Id_Participant = ?";
                    
                    $stmt_verif = mysqli_prepare($idcom, $requete_verif);
                    mysqli_stmt_bind_param($stmt_verif, "s", $Id_Participant);
                    mysqli_stmt_execute($stmt_verif);
                    $result_verif = mysqli_stmt_get_result($stmt_verif);

                    if (mysqli_num_rows($result_verif) > 0) {
                        echo "<div class='error'>L'identifiant est déjà utilisé. Veuillez en choisir un autre.</div>";
                    } else {
                        
                        $requete_insert_1 = "INSERT INTO Participants (Id_Participant, Nom, Prenom, Date_De_Naissance, Nationnalite) VALUES (?, ?, ?, ?, ?)";
                        $requete_insert_2 = "INSERT INTO Membres_De_Comite (Num_Membres_Comite, Mot_De_Passe, Id_Participant) VALUES (?, ?, ?)";
                        

                        $stmt_insert_1 = mysqli_prepare($idcom, $requete_insert_1);
                        mysqli_stmt_bind_param($stmt_insert_1, "sssss", $Id_Participant, $Nom, $Prenom, $Date_De_Naissance, $Nationnalite);
                        mysqli_stmt_execute($stmt_insert_1);

                        $stmt_insert_2 = mysqli_prepare($idcom, $requete_insert_2);
                        mysqli_stmt_bind_param($stmt_insert_2, "sss", $Num_Membres_Comite, $Mot_De_Passe, $Id_Participant);
                        mysqli_stmt_execute($stmt_insert_2);
                        

                        if (mysqli_stmt_affected_rows($stmt_insert_1) > 0 && mysqli_stmt_affected_rows($stmt_insert_2) > 0 ) {
                            echo '
                                <div class="success">Inscription réussie. Vous pouvez maintenant vous connecter.</div>
                                <form method="post" action="Administrator.php">
                                    <div class="link-connexion-inscription">
                                        <ul>
                                            <li><input type="submit" name="Connexion" value="Connexion"></li>
                                        </ul>
                                    </div>
                                </form>
                            ';
                        } else {
                            echo "<div class='error'>Une erreur s'est produite lors de l'inscription. Veuillez réessayer.</div>";
                        }
                    }

                    mysqli_close($idcom);

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