<?php

namespace metier;


use config\Validation;
use Exception;

class Utilisateur
{
    private $idUtilisateur;
    private $nom;
    private $role;
    private $prenom;
    private $sexe;
    private $mail;
    private $adresse;
    private $motDePasse;
    private $inscritAlerte;

    /**
     * Utilisateur constructor.
     * @param $idUtilisateur
     * @param $nom
     * @param $role
     * @param $prenom
     * @param $sexe
     * @param $mail
     * @param $adresse
     * @param $motDePasse
     * @param $inscritAlerte
     */
    public function __construct($idUtilisateur, $nom, $role, $prenom, $sexe, $mail, $adresse, $motDePasse, $inscritAlerte){
        $this->idUtilisateur=$idUtilisateur;
        $this->nom=$nom;
        $this->role=$role;
        $this->prenom=$prenom;
        $this->sexe=$sexe;
        $this->mail=$mail;
        $this->adresse=$adresse;
        $this->motDePasse=$motDePasse;
        $this->inscritAlerte=$inscritAlerte;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @return mixed
     */
    public function getInscritAlerte()
    {
        return $this->inscritAlerte;
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
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $v=new Validation();
        if(isset($nom)) {
            if($v->validateAlnum($nom)) {
                $this->nom = $nom;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $v=new Validation();
        if(isset($role)) {
            if($v->validateAlnum($role)) {
                $this->role = $role;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $v=new Validation();
        if(isset($prenom)) {
            if($v->validateAlnum($prenom)) {
                $this->prenom = $prenom;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $v=new Validation();
        if(isset($sexe)) {
            if($v->validateAlnum($sexe)) {
                $this->sexe = $sexe;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $v=new Validation();
        if(isset($mail)) {
            if($v->validateEmail($mail)) {
                $this->mail = $mail;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $v=new Validation();
        if(isset($adresse)) {
            if($v->validateAlnum($adresse)) {
                $this->adresse = $adresse;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $motDePasse
     */
    public function setMotDePasse($motDePasse)
    {
        $v=new Validation();
        if(isset($motDePasse)) {
            if($v->validateAlnum($motDePasse)) {
                $this->motDePasse = $motDePasse;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }

    /**
     * @param mixed $inscritAlerte
     */
    public function setInscritAlerte($inscritAlerte)
    {
        $v=new Validation();
        if(isset($inscritAlerte)) {
            if($v->validateInt($inscritAlerte)) {
                $this->inscritAlerte = $inscritAlerte;
            }
            else throw new Exception("Variable non valide.");
        }
        else{
            throw new Exception("Variable non défini.");
        }
    }
}
