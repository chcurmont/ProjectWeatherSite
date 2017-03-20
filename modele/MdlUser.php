<?php
/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 16/01/2017
 * Time: 09:30
 */

namespace modele;


use config\Nettoyer;
use config\Validation;
use DAL\LogGateway;
use DAL\UtilisateurTmpGateway;
use DAL\WeatherAPIGateway;
use Exception;

class MdlUser
{
    public function connection()
    {
        global $db_host, $db_login, $db_name, $db_password;
        $g = new \DAL\UserGateway($db_host, $db_name, $db_login, $db_password);
        $logG = $g->selectUtilisateurId($_REQUEST['login']);
        if (!isset($logG)) {
            throw new Exception("erreur utilisateur introuvable");
        }
        if ($logG->getIdUtilisateur() == Nettoyer::nettoyer_string($_REQUEST['login']) && $logG->getMotDePasse() == Nettoyer::nettoyer_string($_REQUEST['pwd'])) {
            $_SESSION['role'] = $logG->getRole();
            $_SESSION['login'] = $logG->getIdUtilisateur();
            $_SESSION['nom'] = $logG->getNom();
            $_SESSION['utilisateur'] = $logG;
            $_SESSION['prenom'] = $logG->getPrenom();

            $lg = new LogGateway($db_host, $db_name, $db_login, $db_password);
            $lg->insertData($_SESSION['login'], "Connexion de l'utilisateur.");
        }
        return $logG;
    }

    function display_array_for_jploty_graph($to_display, $type)
    {
        $to_return = "";
        $to_return = $to_return . "[";
        foreach ($to_display as $current_value) {
            if ($type == "string") {
                $to_return = $to_return . "\"";
            }
            $to_return = $to_return . $current_value;
            if ($type == "string") {
                $to_return = $to_return . "\"";
            }
            $to_return = $to_return . ",";
        }
        $to_return = $to_return . "]";

        return $to_return;
    }

    function display_constant_as_array($mean, $size)
    {
        $i = 0;

        $to_return = "";
        $to_return = $to_return . '[' . $mean;

        $i++;

        while ($i < $size) {
            $to_return = $to_return . ',' . $mean;
            $i++;
        }

        $to_return = $to_return . ']';

        return $to_return;
    }

    /**
     * @throws Exception
     */
    public function graph(){
        global $db_host, $db_login, $db_name, $db_password;
        $_SESSION["is_graph_empty"]='hidden';
        $n = new Nettoyer();
        $v = new Validation();

        if(isset($_POST['data_type'])){
            $_SESSION["is_graph_empty"]=0;

            $_SESSION["data_type"]=$n->nettoyer_string($_POST['data_type']);
            if(!$v->validateAlnum($_SESSION["data_type"])) throw new Exception("Erreur type de données invalide.");

            $_SESSION["date_debut"]=$_POST['date_debut'];
            if(!isset($_SESSION["date_debut"])) throw new Exception("Erreur date non défini.");

            $_SESSION["date_fin"]=$_POST['date_fin'];
            if($_SESSION["date_fin"]=='0001-01-01'){
                $_SESSION["date_fin"]=$_SESSION["date_debut"];
            }

            $_SESSION["graph_title"]=ucfirst($_SESSION["data_type"]).' pour la ';

            if($_SESSION["date_debut"]==$_SESSION["date_fin"]){
                $_SESSION["graph_title"]=$_SESSION["graph_title"].'date du '.$_SESSION["date_debut"];
            }
            else{
                $_SESSION["graph_title"]=$_SESSION["graph_title"].'periode du '.$_SESSION["date_debut"].' au '.$_SESSION["date_fin"];
            }

            $number_values=0;
            $mean=0;

            $error=array();

            $_SESSION["x_axis"]=array();
            $_SESSION["y_axis"]=array();

            $g = new \DAL\DonneesmeteoGateway($db_host,$db_name,$db_login,$db_password);
            $result = $g->selectDay($_SESSION["data_type"],$_SESSION["date_debut"],$_SESSION["date_fin"]);

            if(!count($error)>0){
                foreach($result as $current_result){
                    $_SESSION["x_axis"][] =$current_result->getDate().'/'.$current_result->getHeure();
                    $_SESSION["y_axis"][]=$current_result->getData();
                    $mean=$mean+$current_result->getData();
                    $number_values++;
                }

                $mean=$mean/$number_values;
                $max=max($_SESSION["y_axis"]);
                $min=min($_SESSION["y_axis"]);
            }
            else{
                $erreurTmp = "";
                foreach($error as $current_error){
                    $erreurTmp = $erreurTmp.'Error : '.$current_error.'\n';
                }
                throw new Exception($erreurTmp);
            }

            $size=count($_SESSION["x_axis"]);

            $_SESSION["x_axis_string"]=$this->display_array_for_jploty_graph($_SESSION["x_axis"],"string");
            $_SESSION["mean_array_string"]=$this->display_constant_as_array($mean,$size);
            $_SESSION["max_array_string"]=$this->display_constant_as_array($max,$size);
            $_SESSION["min_array_string"]=$this->display_constant_as_array($min,$size);
        }
    }

    public function data(){
        global $db_host, $db_login, $db_name, $db_password;
        $_SESSION["is_table_empty"]='hidden';
        $n = new Nettoyer();
        $v = new Validation();

        if(isset($_POST['data_type'])){
            $_SESSION["is_table_empty"]='';

            $_SESSION["data_type"]=$n->nettoyer_string($_POST['data_type']);
            if(!$v->validateAlnum($_SESSION["data_type"])) throw new Exception("Erreur type de données invalide.");

            $_SESSION["date_debut"]=$_POST['date_debut'];
            if(!isset($_SESSION["date_debut"])) throw new Exception("Erreur date non défini.");

            $_SESSION["date_fin"]=$_POST['date_fin'];
            if($_SESSION["date_fin"]=='0001-01-01'){
                $_SESSION["date_fin"]=$_SESSION["date_debut"];
            }

            $_SESSION["table_title"]=ucfirst($_SESSION["data_type"]).' pour la ';

            if($_SESSION["date_debut"]==$_SESSION["date_fin"]){
                $_SESSION["table_title"]=$_SESSION["table_title"].'date du '.$_SESSION["date_debut"];
            }
            else{
                $_SESSION["table_title"]=$_SESSION["table_title"].'periode du '.$_SESSION["date_debut"].' au '.$_SESSION["date_fin"];
            }

            $number_values=0;
            $_SESSION["mean"]=0;

            $error=array();

            $g = new \DAL\DonneesmeteoGateway($db_host,$db_name,$db_login,$db_password);
            $result = $g->selectDay($_SESSION["data_type"],$_SESSION["date_debut"],$_SESSION["date_fin"]);

            if(!count($error)>0){
                foreach($result as $current_result){
                    $_SESSION["date"][]=$current_result->getDate();
                    $_SESSION["hour"][]=$current_result->getHeure();
                    $_SESSION["value"][]=$current_result->getData();
                    $_SESSION["mean"]=$_SESSION["mean"]+$current_result->getData();
                    $number_values++;
                }

                if($number_values<=0){
                    $_SESSION["mean"]=0;
                    $_SESSION["max"]=0;
                    $_SESSION["min"]=0;
                }
                else{
                    $_SESSION["mean"]=round($_SESSION["mean"]/$number_values,1);
                    $_SESSION["max"]=max($_SESSION["value"]);
                    $_SESSION["min"]=min($_SESSION["value"]);
                }

            }
            else{
                foreach($error as $current_error){
                    echo 'Error : '.$current_error.'<br/>';
                }
            }

            $_SESSION["size"]=count($_SESSION["value"]);
        }
    }

    public function home($URL){
        $g  = new WeatherAPIGateway($URL);
        return $g->lireAPI();
    }

    public function register(){
        global $db_host,$db_name,$db_login,$db_password;
        $id = Nettoyer::nettoyer_string($_REQUEST['idRegister']);
        $nom = Nettoyer::nettoyer_string($_REQUEST['nameRegister']);
        $prenom = Nettoyer::nettoyer_string($_REQUEST['prenomRegister']);
        $sexe = Nettoyer::nettoyer_string($_REQUEST['sexeRegister']);
        $adresse = Nettoyer::nettoyer_string($_REQUEST['adresse']);
        $password = Nettoyer::nettoyer_string($_REQUEST['passwordRegister']);
        $mail = Nettoyer::nettoyer_email($_REQUEST['mailRegister']);
        $inscritAlerte = Nettoyer::nettoyer_int($_REQUEST['inscritAlerte']);
        $v = new Validation();
        $g = new UtilisateurTmpGateway($db_host,$db_name,$db_login,$db_password);
        if($v->validateEmail($mail) and $v->validateAlnumLongueur($id,15) and $v->validateAlnumLongueur($adresse,200) and $v->validateAlnumLongueur($nom,20) and $v->validateAlnumLongueur($prenom,20) and $v->validateAlnumLongueur($sexe,1) and $v->validateAlnumLongueur($password,500) and $v->validateInt($inscritAlerte)){
            $res = $g->insertUtilisateur($id,$nom,$prenom,$sexe,$mail,$adresse,$password,$inscritAlerte);
            return $res;
        }
        else throw new Exception("Erreur paramètre invalide.");
    }
}