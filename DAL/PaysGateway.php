<?php

/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 05/12/2016
 * Time: 08:25
 */
namespace DAL;

use Exception;
use PDOException;

class PaysGateway
{
    private $con;

    /**
     * PaysGateway constructor.
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

    public function delete($id){

    }
}