<?php

namespace metier;


use config\Validation;
use Exception;

class Depville
{
    private $noDep;
    private $nomVille;

    /**
     * Depville constructor.
     * @param $noDep
     * @param $nomVille
     */
    public function __construct($noDep, $nomVille){
        $this->noDep=$noDep;
        $this->nomVille=$nomVille;
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
    public function getNomVille()
    {
        return $this->nomVille;
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
     * @param mixed $nomVille
     */
    public function setNomVille($nomVille)
    {
        $v=new Validation();
        if(isset($nomVille)) {
            if($v->validateAlnum($nomVille)) {
                $this->nomVille = $nomVille;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }
}