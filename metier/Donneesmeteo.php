<?php

namespace metier;


use config\Validation;
use Exception;

class Donneesmeteo
{
    private $id;
    private $noDep;
    private $date;
    private $heure;
    private $data;

    /**
     * Donneesmeteo constructor.
     * @param $id
     * @param $noDep
     * @param $date
     * @param $heure
     * @param $temperature
     */
    public function __construct($id, $noDep, $date, $heure, $data)
    {
        $this->id=$id;
        $this->noDep=$noDep;
        $this->date=$date;
        $this->heure=$heure;
        $this->data=$data;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNoDep()
    {
        return $this->noDep;
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
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $id
     */
    private function setId($id)
    {
        $v=new Validation();
        if(isset($id)) {
            if($v->validateInt($id)) {
                $this->id = $id;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $noDep
     */
    public function setNoDep($noDep)
    {
        $v=new Validation();
        if(isset($noDep)) {
            if($v->validateInt($noDep)) {
                $this->noDep = $noDep;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
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
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $v=new Validation();
        if(isset($heure)) {
            if($v->validateHeure($heure)) {
                $this->heure = $heure;
            }
            else throw new Exception("Variable non valide");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $v=new Validation();
        if(isset($data)) {
                $this->data = $data;
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }
}