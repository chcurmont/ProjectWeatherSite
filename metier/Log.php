<?php

namespace metier;


use config\Validation;
use Exception;

class Log
{
    private $date;
    private $idUtilisateur;
    private $desc;

    /**
     * Log constructor.
     * @param $date
     * @param $idUtilisateur
     * @param $desc
     */
    public function __construct($date, $idUtilisateur, $desc){
        $this->date=$date;
        $this->idUtilisateur=$idUtilisateur;
        $this->desc=$desc;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        if(isset($date)) {
            $this->date = $date;
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $idUtilisateur
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $v=new Validation();
        if(isset($idUtilisateur)) {
            if($v->validateInt($idUtilisateur)) {
                $this->idUtilisateur = $idUtilisateur;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $v=new Validation();
        if(isset($desc)) {
            if($v->validateAlnum($desc)) {
                $this->desc = $desc;
            }
            else throw new Exception("Variable non défini.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }
}