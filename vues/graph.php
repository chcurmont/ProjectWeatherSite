<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="vues/main.css"/>
		<title>Accueil</title>
		<link rel="icon" href="vues/img/logo_icon.png">
		<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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
                            echo("</form >\n");
                        }
                        ?>
					</div>
					<div id="register" class="button">
						<a href="index.php?action=register">S'inscrire</a>
					</div>
				</div>
			</div>
			<nav class="main_menu">
				<div class="main_button"><a href="index.php?action=home">Accueil</a></div>
				<div class="main_button"><a href="index.php?action=data">Données</div>
				<div class="main_button_current"><a href="index.php?action=graph">Graphiques</a></div>
			</nav>
		</header>
        <div class="main_block">
            <div class="graph_block">
                <h2>Graphique</h2>
                <div id="div_switch">
                    <div>Journée</div>
                    <label class="switch" >
                        <input id="input_switch" type="checkbox" onclick="click_switch()">
                        <div class="slider round"></div>
                    </label>
                    <div>Période</div>
                </div>
                <script>
                    function click_switch(){
                        var x=document.getElementById("input_switch").checked;
                        if (x) {
                            document.getElementById("data_day_form").style.display="none";
                            document.getElementById("data_period_form").style.display="flex";
                        }
                        else{
                            document.getElementById("data_day_form").style.display="flex";
                            document.getElementById("data_period_form").style.display="none";
                        }

                    }
                </script>
                <div id="graph" <?php echo $_SESSION["is_graph_empty"]?>>
                </div>
                <div class="data_form" id="data_day_form">
                    <form method="post" action="index.php?action=graph">
                        <label>Pour un jour</label>
                        <label for="date">Date : </label>
                        <input type="date" name="date_debut" id="date_debut" required/>
                        <input type="date" name="date_fin" value="0001-01-01" hidden/>
                        <label for="data_type">Type de données : </label>
                        <select name="data_type" id="data_type" required>
                            <option value="temperature">Températures</option>
                        </select>
                        <input type="submit" value="Consulter"/>
                    </form>
                </div>

                <div class="data_form" id="data_period_form" style="display:none;">
                    <form method="post" action="index.php?acton=graph">
                        <label>Pour une période</label>
                        <label for="date">Depuis : </label>
                        <input type="date" name="date_debut" id="date_debut" required/>
                        <label for="date">Jusque : </label>
                        <input type="date" name="date_fin" id="date_fin" required/>
                        <label for="data_type">Type de données : </label>
                        <select name="data_type" id="data_type" required>
                            <option value="temperature">Températures</option>
                        </select>
                        <input type="submit" value="Consulter"/>
                    </form>
                </div>
            </div>
        </div>
		<script>
			<?php
                echo 'var is_graph_empty='.$_SESSION["is_graph_empty"];

			?>;
		
			if(is_graph_empty==0){
				var trace1 = {
					x: <?php echo $_SESSION["x_axis_string"]?>,
					y: <?php echo display_array_for_jploty_graph($_SESSION["y_axis"],"float")?>,
					type: 'line',
					name : 'valeurs'
				};
				
				var trace2 = {
					x: <?php echo $_SESSION["x_axis_string"]?>,
					y: <?php echo $_SESSION["mean_array_string"]?>,
					type : 'line',
					name : 'moyenne'
				};
				
				var trace3 = {
					x: <?php echo $_SESSION["x_axis_string"]?>,
					y: <?php echo $_SESSION["min_array_string"]?>,
					type : 'line',
					name : 'minimum'
				};
				
				var trace4 = {
					x: <?php echo $_SESSION["x_axis_string"]?>,
					y: <?php echo $_SESSION["max_array_string"]?>,
					type : 'line',
					name : 'maximum'
				};
				
				var data = [trace1,trace2,trace3,trace4];
			}

			var layout = {
				title: '<?php echo ucfirst($_SESSION["graph_title"])?>',
				xaxis: {
					title: 'heure'
				},
				yaxis: {
					title: '<?php echo $_SESSION["data_type"]?>'
				}
			};

			Plotly.newPlot('graph', data, layout);
		</script>
		<footer>
			<div class="footer_info">
				<p>
					Projet tutoré n°17- GIRAUD-PEPIN Nicolas (chef de projet), HEBERT Florian, CURMONT Charly, COMBE Etienne, FRANCOIS Thomas
				</p>
			</div>
		</footer>
	</body>
</html>
