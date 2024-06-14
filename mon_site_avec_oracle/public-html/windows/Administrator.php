<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paris 2024 - Connexion ou inscription</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../Css/nav-style.Css"/>
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
        <div class="Admin-head-container">
            <!-- Liens de connexion ou d'inscription -->
            <form method="post">
                    <div class="link-connexion-inscription">
                        <ul>
                            <li><input type="submit" name="Connexion" value="Connexion"></li>
                            <li><input type="submit" name="Inscription" value="Inscription"></li>
                        </ul>
                    </div>
            </form>

            <?php
            if (isset($_POST["Connexion"])) {
                echo '
                <div class="connexion-inscription">
                    <h2>Connexion ...</h2>

                    <form method="POST" action="connexion.php">
                        <div>
                            <label for="Identifiant">Identifiant :</label>
                            <input type="text" id="Identifiant" name="Identifiant" required>
                        </div>
                        <div>
                            <label for="password">Mot de passe :</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <input type="submit" name="submit" value="Se connecter">
                        </div>
                    </form>
                    <div >
                        <a href="http://localhost/mon_site_2/windows/Administrator.php">Mot de passe ou nom d"utilisateur oublié ?</a>
                    </div>
                </div>
                ';
                }elseif (isset($_POST["Inscription"])) { 
                    echo '
                    <div class="connexion-inscription">
                        <h2>Inscription ...</h2>
    
                        <form method="POST" action="inscription.php">
                            <div>
                                <label for="Nom">Nom :</label>
                                <input type="text" id="Nom" name="Nom" required>
                            </div> 
                            <div>
                                <label for="Prénom">Prénom :</label>
                                <input type="text" id="Prénom" name="Prenom" required>
                            </div>                          
                            <div>
                                <label for="Date de naissance">Date de naissance :</label>
                                <input type="date" id="Date de naissance" name="Date_De_Naissance" required>
                            </div>
                            <div>
                                <label for="Nationalité">Nationalité :</label>
                                <input type="text" id="Nationalité" name="Nationnalite" required>
                            </div>

                            <div>
                                <label for="Identifiant">Identifiant :</label>
                                <input type="text" id="Identifiant" name="Identifiant" required>
                            </div>  
                            <div>
                                <label for="password">Mot de passe :</label>
                                <input type="password" id="password" name="password" required>
                            </div>  
                            <div>
                                <label for="password-confirm">Confirmer le mot de passe :</label>
                                <input type="password" id="password-confirm" name="password-confirm" required>
                                
                            </div>
                            <div>
                                <input type="submit" name="submit" value="S\'inscrire">
                            </div>
                        </form>
                    </div>
                    ';
            }
            ?>
        </div>
    </div>
</body>
</html>