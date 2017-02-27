<?php


namespace metier;


use config\Validation;
use Exception;

class Villeutilisateur
{
    private $idUtilisateur;
    private $nomVille;

    /**
     * Villeutilisateur constructor.
     * @param $idUtilisateur
     * @param $nomVille
     */
    public function __construct($idUtilisateur, $nomVille){
        $this->idUtilisateur=$idUtilisateur;
        $this->nomVille=$nomVille;
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
    public function getNomVille()
    {
        return $this->nomVille;
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