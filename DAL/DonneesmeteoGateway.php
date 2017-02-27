<?php

/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 08/12/2016
 * Time: 14:10
 */
namespace DAL;

use Exception;
use modele\Donneesmeteo;
use PDO;
use PDOException;

class DonneesmeteoGateway
{
    private $con;

    /**
     * DonneesmeteoGateway constructor.
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

    public function selectDay($data_type,$D1, $D2){
        try {
            $query = "select id,noDep,date,heure,:data_type from tdonneesmeteo where (date >= :date_debut and date <= :date_debut)";
            $this->con->executeQuery($query, array(
                ':data_type' => array($data_type,PDO::PARAM_STR),
                ':date_debut' => array($D1, PDO::PARAM_STR),
                ':date_fin' => array($D2, PDO::PARAM_STR)
            ));
            $rep=$this->con->getResults();
            $ligne=[];
            $i=0;
            $res=[];
            foreach($rep as $ligne){
                $res[$i]=new \metier\Donneesmeteo($ligne['id'],$ligne['noDep'],$ligne['date'],$ligne['heure'],$ligne["$data_type"]);
                $i=$i+1;
            }
            if($res!=[]){
                return $res;
            }
            throw new Exception("Erreur lors du chargement des données.");
        }
        catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }
}