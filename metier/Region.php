<?php

namespace metier;


use config\Validation;
use Exception;

class Region
{
    private $noReg;
    private $nomRegion;
    private $nomPays;

    /**
     * Region constructor.
     * @param $noReg
     * @param $nomRegion
     * @param $nomPays
     */
    public function __construct($noReg, $nomRegion, $nomPays)
    {
        $this->nomPays=$nomPays;
        $this->nomRegion=$nomRegion;
        $this->noReg=$noReg;
    }

    /**
     * @return mixed
     */
    public function getNoReg()
    {
        return $this->noReg;
    }

    /**
     * @return mixed
     */
    public function getNomRegion()
    {
        return $this->nomRegion;
    }

    /**
     * @return mixed
     */
    public function getNomPays()
    {
        return $this->nomPays;
    }

    /**
     * @param mixed $noReg
     */
    public function setNoReg($noReg)
    {
        $v=new Validation();
        if(isset($noReg)) {
            if($v->validateInt($noReg)) {
                $this->noReg = $noReg;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $nomRegion
     */
    public function setNomRegion($nomRegion)
    {
        $v=new Validation();
        if(isset($nomRegion)) {
            if($v->validateAlnum($nomRegion)) {
                $this->nomRegion = $nomRegion;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $nomPays
     */
    public function setNomPays($nomPays)
    {
        $v=new Validation();
        if(isset($nomPays)) {
            if($v->validateAlnum($nomPays)) {
                $this->nomPays = $nomPays;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }
}