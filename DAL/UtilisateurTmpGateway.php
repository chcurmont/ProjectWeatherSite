<?php

namespace DAL;


use Exception;
use metier\Utilisateurtmp;
use PDOException;

class UtilisateurTmpGateway
{
    public function __construct($dbHost, $dbName, $user, $pass)
    {
        try {
            $this->con = new Connection('mysql:host=' . $dbHost . ';dbname=' . $dbName, $user, $pass);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function nbDemande(){
        try{
            $query =  'select count(*) from tutilisateurstmp';
            return $this->con->executeQuery($query);
        }
        catch(\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function utilisateursPresent(){
        try{
            $query = "select * from tutilisateurstmp";
            $this->con->executeQuery($query);
            $res = $this->con->getResults();
            if($res == []){
                return null;
            }
            $retour = [];
            foreach ( $res as $line) {
                $retour[] = new Utilisateurtmp($line['idUtilisateur'],$line['nom'],$line['prenom'],$line['sexe'],$line['mail'],$line['adresse'],$line['motDePasse'],$line('inscritAlerte'));
            }
            return $retour;
        }

        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deleteId($id){
        try {
            $query = "delete from tutilisateurstmp where idUtilisateur = :id";
            return $this->con->executeQuery($query, array(":id" => array($id, \PDO::PARAM_STR)));
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
    public function deleteAll(){
        try {
            $query = "delete from tutilisateurstmp";
            return $this->con->executeQuery($query);
        }
        catch(PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function selectId($id){
        try{
            $query = "select * from tutilisateurstmp where idUtilisateur = :id";
            $this->con->executeQuery($query,array("id"=>array($id,\PDO::PARAM_STR)));
            $res = $this->con->getResults();
            return new Utilisateurtmp($res[0]['idUtilisateur'],$res[0]['nom'],$res[0]['prenom'],$res[0]['sexe'],$res[0]['mail'],$res[0]['adresse'],$res[0]['motDePasse'],$res[0]['inscritAlerte']);
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    public function insertUtilisateur($id,$nom,$prenom,$sexe,$mail,$adresse,$motDePasse,$inscritAlerte){
        try{
            $query = "insert into tutilisateurstmp values(:id,:nom,:prenom,:sexe,:mail,:adresse,:motDePasse,:inscritAlerte)";
            return $this->con->executeQuery($query,array(
                ":id"=>array($id,\PDO::PARAM_STR),
                ":nom"=>array($nom,\PDO::PARAM_STR),
                ":prenom"=>array($prenom,\PDO::PARAM_STR),
                ":sexe"=>array($sexe,\PDO::PARAM_STR),
                ":mail"=>array($mail,\PDO::PARAM_STR),
                ":adresse"=>array($adresse,\PDO::PARAM_STR),
                ":motDePasse"=>array($motDePasse,\PDO::PARAM_STR),
                ":inscritAlerte"=>array($inscritAlerte,\PDO::PARAM_INT)
            ));
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}