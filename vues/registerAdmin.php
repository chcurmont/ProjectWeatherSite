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
<?php
if($utilisateurs!=[]){
    echo("<ul>");
    foreach ($utilisateurs as $utilisateur){
        echo($utilisateur);
        echo("<form method = \"post\" action = \"index.php?action=ValiderUtilisateur\">\n");
        $_SESSION['utilisateurAEnregistrer'] = $utilisateur;
        echo("input type = \"submit\" value = 0");
        echo("</form>");
        echo("<a href = \"index.php?action=refuser&idRefuse=".$utilisateur->getIdUtilisateur()."\" >Refusé </a>");
    }
}
?>
<footer>
    <div class="footer_info">
        <p>
            Projet tutoré n°17- GIRAUD-PEPIN Nicolas (chef de projet), HEBERT Florian, CURMONT Charly, COMBE Etienne, FRANCOIS Thomas
        </p>
    </div>
</footer>
</body>
</html>