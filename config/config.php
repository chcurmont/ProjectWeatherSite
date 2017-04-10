<?php


$db_host="localhost";
$db_name="mydb";
$db_login="root";
$db_password="password";

$dir=__DIR__."/../";

$vues['error']='vues/erreur.php';
$vues['data']='vues/data.php';
$vues['home']='vues/home.php';
$vues['graph']='vues/graph.php';
$vues['admin']='vues/admin.php';
$vues['indexCss']='vues/main.css';
$vues['index']='index.php';
$vues['register']='vues/register.php';

$vue='home';

$err=null;

$actions=[];
$actions[]='home';
$actions[]='graph';
$actions[]='data';
$actions[]='connection';
$actions[]='register';

$actionsAdmin=[];
$actionsAdmin[]='home';
$actionsAdmin[]='graph';
$actionsAdmin[]='data';
$actionsAdmin[]='deconnection';
$actionsAdmin[]='adminPage';

$actionsSU=[];
$actionsSU[]='home';
$actionsSU[]='graph';
$actionsSU[]='data';
$actionsSU[]='deconnection';
$actionsSU[]='adminPage';

$URL_API = "http://query.yahooapis.com/v1/public/yql";