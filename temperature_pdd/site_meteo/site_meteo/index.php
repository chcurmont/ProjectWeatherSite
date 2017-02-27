<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="main.css"/>
		<title>Accueil</title>
		<link rel="icon" href="resources/img/logo_icon.png">
	</head>
	<body>
		<header>
			<div class="main_header">
				<a href="index.php"><img width="100px" src="resources/img/logo.png" alt="Logo du site"/></a>
				<div class="header_title"><h1><a href="index.php">Morpheo Stats</a></h1></div>
				<div class="header_login">
					<div style="margin-bottom: 10px;">
						<form class="login" method="post" action="index.php">
							Login:<input type="text" name="login"/>
							Password:<input type="password" name="pwd"/>
							<input type="submit" value="Se connecter"/>
						</form>
					</div>
					<div id="register" class="button">
						<a href="register.html">S'inscrire</a>
					</div>
				</div>
			</div>
			<nav class="main_menu">
				<div class="main_button_current"><a href="index.php">Accueil</a></div>
				<div class="main_button"><a href="data.php">Données</a></div>
				<div class="main_button"><a href="graph.php">Graphiques</a></div>
			</nav>
		</header>
		<div class="main_block">
			<h2>Accueil</h2>
			<h3>Informations</h3>
			<p>
				Bienvenue sur Morpheo Stats ! Ce site constitue un outil d'étude statistiques météorologiques qui vous permettra de consulter (soit directement, soit sous forme de graphes) des données météorologiques recueillies au sommet du Puy-de-Dôme.
			</p>
			<p>
				Ce site a été développé dans le cadre d'un projet tutoré de deuxième année à l'IUT d'Informatique des Cézeaux à Clermont-Ferrand (63).
			</p>
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