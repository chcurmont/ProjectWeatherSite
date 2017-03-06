<?php

/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 08/12/2016
 * Time: 14:16
 */
namespace DAL;

use Exception;
use PDO;
use PDOException;

class LogGateway
{
    private $con;

    /**
     * LogGateway constructor.
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

    public function insertData($idUtilisateur,$desc){
        try{
            $query = "insert into tlog values(0,sysdate(),:idUtilisateur,:desc)";
            return $this->con->executeQuery($query,array(
                ':idUtilisateur'=>array($idUtilisateur, PDO::PARAM_STR),
                ':desc'=>array($desc,PDO::PARAM_STR)
                ));
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}