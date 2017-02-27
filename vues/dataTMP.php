<?php
	$is_table_empty='hidden';
	$size=0;
	if(isset($_POST['data_type'])){
		$is_table_empty='';
		
		$data_type=$_POST['data_type'];
		$date_debut=$_POST['date_debut'];
		$date_fin=$_POST['date_fin'];
		if($date_fin=='0001-01-01'){
			$date_fin=$date_debut;
		}
		
		$table_title=ucfirst($data_type).' pour la ';
		
		if($date_debut==$date_fin){
			$table_title=$table_title.'date du '.$date_debut;
		}
		else{
			$table_title=$table_title.'periode du '.$date_debut.' au '.$date_fin;
		}
		
		$number_values=0;
		$mean=0;
		
		$error=array();
		
		try{
			$db = new PDO('mysql:host=localhost;dbname=site_meteo;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e){
			die('Error : '.$e->getMessage());
		}
		
		try{
			$query_str = "select day_date,heure,".$data_type." from tdonneesmeteo where (day_date >= '".$date_debut."' and day_date <= '".$date_fin."')";
			$result=$db->prepare($query_str);
			$result->execute();
		}
		catch(PDOException $e){
			$error[]=$e;
		}
		
		if(!count($error)>0){
			while($current_result=$result->fetch()){
				$date[]=$current_result['day_date'];
				$hour[]=$current_result['heure'];
				$value[]=$current_result[$data_type];
				$mean=$mean+$current_result[$data_type];
				$number_values++;
			}
			$result->closeCursor();
			if($number_values<=0){
				$mean=0;
				$max=0;
				$min=0;
			}
			else{
				$mean=$mean/$number_values;
				$max=max($value);
				$min=min($value);
			}
			
		}
		else{		
			foreach($error as $current_error){
				echo 'Error : '.$current_error.'<br/>';
			}
		}
		$size=count($value);
	}
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
				<div class="main_button_current"><a href="data.php">Données</div>
				<div class="main_button"><a href="graph.php">Graphiques</a></div>
			</nav>
		</header>
		<div class="main_block">
			<div class="graph_block">
				<h2>Donnees</h2>
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
				<div class="data_form" id="data_day_form">
					<form method="post" action="data.php">
						<label>Pour un jour</label>
						<label for="date">Date : </label>
						<input type="date" name="date_debut" id="date_debut" required/>
						<input type="date" name="date_fin" value="0001-01-01" hidden/>
						<label for="data_type">Type de données : </label>
						<select name="data_type" id="data_type" required>
							<option value="temperature">Températures</option>
						</select>
						<label>Export</label>
						<input type="checkbox" name="export_ok" value="export_ok">
						<input type="submit" value="Consulter"/>
						<?php
						if (isset($_POST['export_ok'])) {
							echo "Fichier exporté";
							if(null==fopen('data.csv', 'r+')){
								$file=fopen('data.csv','a');
							}
							else{
								$file=fopen('data.csv','r+');
							}
							fputcsv($file,array("date","temps","temp"));
							$i=0;
							while ($i<$size) {
								fputcsv($file,array($date[$i],$hour[$i],$value[$i]));
								$i++;
							}
							fclose($file);
						}
						?>
					</form>
				</div>
				
				<div class="data_form" id="data_period_form" style="display:none;">
					<form method="post" action="data.php">
						<label>Pour une période</label>
						<label for="date">Depuis : </label>
						<input type="date" name="date_debut" id="date_debut" required/>
						<label for="date">Jusque : </label>
						<input type="date" name="date_fin" id="date_fin" required/>
						<label for="data_type">Type de données : </label>
						<select name="data_type" id="data_type" required>
							<option value="temperature">Températures</option>
						</select>
						<label>Export</label>
						<input type="checkbox" name="export_ok" value="export_ok">
						<input type="submit" value="Consulter"/>
					</form>

				</div>
				
<?php
				if(isset($table_title)){
?>
				
				<div class="data_table" <?php echo $is_table_empty?>>
					<h3><?php echo $table_title?></h3>
					<div class="info_display">
						<label style="color:green">Moyenne : <?php echo $mean?></label>
						<label style="color:red">Maximum : <?php echo $max?></label>
						<label style="color:blue">Minimum : <?php echo $min?></label>
					</div>
					<table>
						<tr>
							<th>
								Date
							</th>
							<th>
								Heure
							</th>
							<th>
								<?php echo ucfirst($data_type)?>
							</th>
						</tr>
						<?php
							$i=0;
							while($i<$size){
						?>
							<tr>
								<td>
									<?php echo $date[$i]?>
								</td>
								<td>
									<?php echo $hour[$i]?>
								</td>
								<td>
									<?php echo $value[$i]?>
								</td>
							</tr>
						<?php
								$i++;
							}
						?>
					</table>
				</div>
<?php
				}
?>
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