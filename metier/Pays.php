<?php

namespace metier;


use config\Validation;
use Exception;

class Pays
{
    private $nomPays;

    /**
     * Pays constructor.
     * @param $nomPays
     */
    public function __construct($nomPays)
    {
        $this->nomPays=$nomPays;
    }

    /**
     * @return mixed
     */
    public function getNomPays()
    {
        return $this->nomPays;
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