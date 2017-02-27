<?php
	$is_table_empty=1;

	if(isset($_POST['data_type'])){
		$is_table_empty=0;
		
		$data_type=$_POST['data_type'];
		$date=$_POST['date'];
		$number_values=0;
		$mean=0;
		
		$error=array();
		
		$x_axis=array();
		$y_axis=array();
		
		try{
			$db = new PDO('mysql:host=localhost;dbname=site_meteo;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e){
			die('Error : '.$e->getMessage());
		}
		
		try{
			$query_str = "select heure,".$data_type." from tdonneesmeteo where day_date = '".$date."'";
			$result=$db->query($query_str);
		}
		catch(PDOException $e){
			$error[]=$e;
		}
		
		if(!count($error)>0){
			while($current_result=$result->fetch()){
				$x_axis[]=$current_result['heure'];
				$y_axis[]=$current_result[$data_type];
				$mean=$mean+$current_result[$data_type];
				$number_values++;
			}
			$result->closeCursor();
			
			$mean=$mean/$number_values;
			$max=max($y_axis);
			$min=min($y_axis);
		}
		else{		
			foreach($error as $current_error){
				echo 'Error : '.$current_error.'<br/>';
			}
		}
	}
	
	$size=count($x_axis);
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="main.css"/>
		<title>Accueil</title>
		<link rel="icon" href="resources/img/logo_icon.png">
		<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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
				<div class="main_button"><a href="index.php">Accueil</a></div>
				<div class="main_button"><a href="data.php">Données</div>
				<div class="main_button_current"><a href="graph.php">Graphiques</a></div>
			</nav>
		</header>
		<div class="main_block">
			<div class="graph_block">
			<h2>Graphique</h2>
			<div id="graph">
			</div>
				<div class="data_form">
					<form method="post" action="graph.php">
						<label for="date">Jour : </label>
						<input type="date" name="date" id="date" required/>
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
			var is_graph_empty = <?php echo $is_graph_empty?>;
		
			if(is_graph_empty==0){
				var trace1 = {
					x: <?php echo $x_axis_string?>,
					y: <?php echo display_array_for_jploty_graph($y_axis,"float")?>,
					type: 'line',
					name : 'valeurs'
				};
				
				var trace2 = {
					x: <?php echo $x_axis_string?>,
					y: <?php echo $mean_array_string?>,
					type : 'line',
					name : 'moyenne'
				};
				
				var trace3 = {
					x: <?php echo $x_axis_string?>,
					y: <?php echo $min_array_string?>,
					type : 'line',
					name : 'minimum'
				};
				
				var trace4 = {
					x: <?php echo $x_axis_string?>,
					y: <?php echo $max_array_string?>,
					type : 'line',
					name : 'maximum'
				};
				
				var data = [trace1,trace2,trace3,trace4];
			}
			else{
				var trace1 = {
					x:[1,1,1,1],
					y:[1,2,3,4],
					type:'line'
				}
				
				var data = [trace1];
			}
			
			var layout = {
				title: '<?php echo ucfirst($data_type)?> pour le <?php echo $date?>',
				xaxis: {
					title: 'heure'
				},
				yaxis: {
					title: '<?php echo $data_type?>'
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