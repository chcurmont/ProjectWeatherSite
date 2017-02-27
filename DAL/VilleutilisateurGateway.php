<?php

/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 08/12/2016
 * Time: 14:17
 */
namespace DAL;

use Exception;
use PDOException;

class VilleutilisateurGateway
{
    private $con;

    /**
     * VilleutilisateurGateway constructor.
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
}