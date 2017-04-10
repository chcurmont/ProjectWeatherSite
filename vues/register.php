<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="vues/main.css"/>
    <title>Accueil</title>
    <link rel="icon" href="vues/img/logo_icon.png">
</head>
<body>
<header>
    <div class="main_header">
        <a href="index.php"><img width="100px" src="vues/img/logo.png" alt="Logo du site"/></a>
        <div class="header_title"><h1><a href="index.php">Morpheo Stats</a></h1></div>
        <div class="header_login">
            <div style="margin-bottom: 10px;">
                <?php
                if(isset($_SESSION['login']) && isset($_SESSION['role']) && isset($_SESSION['nom']) && isset($_SESSION['prenom']) && isset($_SESSION['utilisateur'])){
                    echo("<form class=\"login\" method = \"post\" action = \"index.php?action=adminPage\">\n");
                    echo("Nom: ".$_SESSION["nom"]."\n");
                    echo("Prénom: ".$_SESSION["prenom"]."\n");
                    echo("<input class=\"input_connexion\" type = \"submit\" value = \"page admin\" />\n");
                    echo("<a href=\"index.php?action=deconnection\"> Se déconnecter </a>");
                    echo("</form>\n");
                }
                else {
                    $vue = 'home';
                    echo("<form class=\"login\" method = \"post\" action = \"index.php?action=connection\" >\n");
                    echo("Login:<input class = \"input1\" type = \"text\" name = \"login\" value = \"login\"/>\n");
                    echo("Password:<input class = \"input2\" type = \"password\" name = \"pwd\" value = \"password\"/>\n");
                    echo("<input class = \"input_connexion\" type = \"submit\" value = \"Se connecter\" />\n");
                    echo("<a href=\"index.php?action=register\">S'inscrire</a>");
                    echo("</form >\n");
                }
                ?>
            </div>
        </div>
    </div>
    <nav class="main_menu">
        <div class="main_button_current"><a href="index.php?action=home">Accueil</a></div>
        <div class="main_button"><a href="index.php?action=data">Données</a></div>
        <div class="main_button"><a href="index.php?action=graph">Graphiques</a></div>
    </nav>
</header>
<form class="register" method = "post" action = "index.php?action=register">
    <p>Login: </p><input class = "input3" type = "text" name = "idRegister" value = "Votre identifiant" required/>
    <p>Nom: </p><input class = "input4" type = "text" name = "nameRegister" value = "Votre nom" required/>
    <p>Prenom: </p><input class = "input5" type ="text" name = "prenomRegister" value = "Votre prénom" required/>
    <p>Sexe(Optionnel): </p><select name = "sexeRegister" required>
        <option value = "u" selected>Undefined</option>
        <option value = "m">Homme</option>
        <option value = "f">Femme</option>
    </select>
    <p>Mail: </p><input class = "input6" type = "email" name = "mailRegister" value = "Votre mail" required/>
    <p>Adresse: </p><input class = "input7" type = "text" name = "adresseRegister" value = "Votre adresse" required/>
    <p>Mot de passe: </p><input class = "input8" type = "password" name = "passwordRegister" value ="" required/>
    <p>Inscrit alerte: </p><input class = "input9" type = "checkbox" name = "inscritAlerte" value = "0"/>
    <input class = "input_register" type ="submit" value = "utilisateurAEnregistrer"/>
</form>
<footer>
    <div class="footer_info">
        <p>
            Projet tutoré n°17- GIRAUD-PEPIN Nicolas (chef de projet), HEBERT Florian, CURMONT Charly, COMBE Etienne, FRANCOIS Thomas
        </p>
    </div>
</footer>
</body>
</html>