<?php

namespace metier;


use config\Validation;
use Exception;

class Departement
{
    private $noDep;
    private $nomDep;
    private $noReg;

    /**
     * Departement constructor.
     * @param $noDep
     * @param $noReg
     * @param $nomDep
     */
    public function  __construct($noDep, $noReg, $nomDep){
        $this->noDep=$noDep;
        $this->nomDep=$nomDep;
        $this->noReg=$noReg;
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
    public function getNomDep()
    {
        return $this->nomDep;
    }

    /**
     * @return mixed
     */
    public function getNoReg()
    {
        return $this->noReg;
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
            else throw new Exception("variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $nomDep
     */
    public function setNomDep($nomDep)
    {
        $v=new Validation();
        if(isset($nomDep)) {
            if($v->validateAlnum($nomDep)) {
                $this->nomDep = $nomDep;
            }
            else throw new Exception("variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
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
            else throw new Exception("variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }
}