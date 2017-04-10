<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="vues/main.css"/>
		<title>Admin</title>
		<link rel="icon" href="vues/resources/img/logo_icon.png">
	</head>
	<body>
		<header>
			<div class="main_header">
				<a href="index.php"><img width="100px" src="vues/resources/img/logo.png" alt="Logo du site"/></a>
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
				<div class="main_button"><a href="index.php?action=home">Accueil</a></div>
				<div class="main_button"><a href="index.php?action=data">Données</a></div>
				<div class="main_button"><a href="index.php?action=graph">Graphiques</a></div>
			</nav>
		</header>
		<div class="main_block">
			<h2>Administrateur</h2>
				<div class="admin_panel">
					<input type="file" name="file" id="file" class="inputfile"  onChange="display_file()"/>
					<label for="file" id="inputfile_label">Choisir fichier</label>
					<div id="result"></div>
					<input type="button" name="buttonfile" id="buttonfile" class="inputbutton"/>
					<label for="button" id="inputbutton_label" style="display: none;">Valider</label>
					<div id="export">

						<input type="button" name="button" id="button" class="inputexport"/>
						<label for="button" id="inputexport_label">Exporter en 	fichier</label>
					</div>
				</div>
				<script>
					function display_file(){
						var fileValue=document.getElementById("file");
						var resultFile=document.getElementById("result");
						resultFile.innerHTML=fileValue.value;
						document.getElementById("inputbutton_label").style.display="flex";
					}
				</script>
				<div class="data_form" id="data_admin_form">
					<form method="post" action="index.php?action=data">
						<label for="date"/>Date : </label>
						<input type="date" name="date_debut" id="date_debut" required/>
						<input type="date" name="date_fin" value="0001-01-01" hidden/>
						<label for="data_type">Type de données : </label>
						<select name="data_type" id="data_type" required>
							<option value="temperature">Températures</option>
						</select>
						<input type="submit" value="Enregistrer"/>
					</form>
				</div>
		</div>

		<footer>
			<div class="footer_info">
				<p>
					Projet tutoré n°17- GIRAUD-PEPIN Nicolas (chef de projet), HEBERT Florian, CURMONT Charly, COMBE Etienne, FRANCOIS Thomas
				</p>
			</div>
		</footer>
	</body>
</html>