<?php

/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 05/12/2016
 * Time: 10:07
 */
namespace DAL;

use Exception;
use metier\Utilisateur;
use PDOException;

class UserGateway
{
    private $con;

    /**
     * UserGateway constructor.
     * @param $dbHost
     * @param $dbName
     * @param $user
     * @param $pass
     * @throws Exception
     */
    public function __construct($dbHost, $dbName, $user, $pass){
        try{
            $this->con = new Connection('mysql:host='.$dbHost.';dbname='.$dbName,$user,$pass);
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delete($id){
        try{
            $query="delete from tutilisateur where idUtilisateur=:id";
            return $this->con->executeQuery($query,array(':id'=>array($id,\PDO::PARAM_STR)));
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return Utilisateur
     * @throws Exception
     */
    public function selectUtilisateurId($id){
        try{
            $query="select * from tutilisateur where idUtilisateur=:id";
            $this->con->executeQuery($query,array(':id'=>array($id,\PDO::PARAM_STR)));
            $res=$this->con->getResults();
            if($res==[]){
                throw new Exception("pas de données valides selectioner");
            }
            return new Utilisateur($res[0]['idUtilisateur'],$res[0]['nom'],$res[0]['role'],$res[0]['prenom'],$res[0]['sexe'],$res[0]['mail'],$res[0]['adresse'],$res[0]['motDePasse'],$res[0]['inscritAlerte']);
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}