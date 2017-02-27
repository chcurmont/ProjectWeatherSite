<?php

/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 08/12/2016
 * Time: 14:09
 */
namespace DAL;

use Exception;
use modele\Departement;
use PDOException;

class DepartementGateway
{
    private $con;

    /**
     * DepartementGateway constructor.
     * @param $dbHost
     * @param $dbName
     * @param $user
     * @param $pass
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
     * @param $noDep
     * @return Departement|null
     */
    public function selectDepartementNoDep($noDep){
        try{
            $querry='SELECT * from tdepartement where noDep=:noDep';
            $this->con->executeQuery($querry,array(':noDep'=>array($noDep,\PDO::PARAM_INT)));
            $res=$this->con->getResults();
            if($res==[]){
                return NULL;
            }
            return new Departement($res[0]['noDep'],$res[0]['noReg'],$res[0]['nomDep']);
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}