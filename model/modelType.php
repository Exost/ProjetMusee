<?php

require('model.php');
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 22/11/15
 * Time: 22:22
 */
class modelType extends Model
{
    private $nom;
    static $table = "Type" ;
    static $primary = "nom" ;

    /**
     * modelType constructor.
     * @param $nom
     */
    public function __construct($nom=NULL)
    {
        if(!is_null($nom)){
            $this->nom = $nom;
        }

    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }


}