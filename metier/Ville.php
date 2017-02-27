<?php

namespace metier;


use config\Validation;
use Exception;

class Ville
{
    private $nomVille;

    /**
     * Ville constructor.
     * @param $nomVille
     */
    public function __construct($nomVille){
        $this->nomVille=$nomVille;
    }

    /**
     * @return mixed
     */
    public function getNomVille()
    {
        return $this->nomVille;
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