<?php

require_once('model.php');
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 19/11/15
 * Time: 16:41
 */
class modelMembre extends  Model
{
    static $table = "Membre" ;
    static $primary = "login" ;

    private $login;
    private $nom;
    private $prenom;
    private $adresse_mail;
    private $sexe;
    private $mot_de_passe;


    /*
     *constructeur
     */
    public function __construct($log=NULL,$nom=NULL,$prenom=NULL,
        $adresse=NULL, $sexe=NULL, $mdp=NULL){
        if(!is_null($log)&&!is_null($nom)&&!is_null($prenom)&&
            !is_null($adresse)&&!is_null($sexe)&&!is_null($mdp)){
            $this->login=$log;
            $this->nom=$nom;
            $this->prenom =$prenom;
            $this->adresse_mail=$adresse;
            $this->sexe=$sexe;
            $this->mot_de_passe=$mdp;
        }
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->mot_de_passe;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return mixed
     */
    public function getAdresseMail()
    {
        return $this->adresse_mail;
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
    public function getLogin()
    {
        return $this->login;
    }



}