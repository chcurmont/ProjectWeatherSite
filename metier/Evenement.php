<?php

namespace metier;


use config\Validation;
use Exception;

class Evenement
{
    private $date;
    private $noDep;
    private $type;
    private $desc;

    /**
     * Evenement constructor.
     * @param $date
     * @param $noDep
     * @param $type
     * @param $desc
     */
    public function __construct($date, $noDep, $type, $desc)
    {
        $this->date = $date;
        $this->noDep = $noDep;
        $this->desc = $desc;
        $this->type = $type;
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
    public function getNoDep()
    {
        return $this->noDep;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
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
     * @param mixed $type
     */
    public function setType($type)
    {
        $v=new Validation();
        if(isset($type)) {
            if($v->validateAlnum($type)) {
                $this->type = $type;
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
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }
}