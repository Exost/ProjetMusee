<?php
require_once "{$ROOT}{$DS}config{$DS}Conf.php";

class Model{

    public static $pdo;

    public static function Init(){
        $host = conf::getHostname();
        $dbname= conf::getDataBase();
        $login= conf::getLogin();
        $pass= conf::getPassword();
        try{
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname",$login,$pass);

        }catch(PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();}

    }



    static function select($para) {
        $sql = "SELECT * from ".static::$table." WHERE ".static::$primary."=:nom_var";
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(":nom_var", $para);
            $req_prep->execute();
            $nomModel =  'model'.substr(static::$table , 3) ;
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $nomModel );
            if ($req_prep->rowCount()==0){
                return null;
                die();// Vérifier si $req_prep->rowCount() != 0
            }else{
                $rslt = $req_prep->fetch();
                return $rslt;}
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


    public static function getAll(){
        $SQL="SELECT * FROM ".static::$table." ";
        //echo $SQL ;
        try{
            $req_prep = Model::$pdo->query($SQL);
            //print_r( $req_prep );
            $nomModel =  'model'.substr(static::$table , 3) ;
            $req_prep->setFetchMode(PDO::FETCH_CLASS, $nomModel );
            $all_Art = $req_prep->fetchAll(); ;
            return $all_Art ;
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="www.google.com"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


    public static function countElem (){
        $sql = 'SELECT count(:elem) AS ResCount
                FROM '.static::$table.'';
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(':elem', static::$primary);
            $req_prep->execute();

        }catch (PDOException $e){
            if(Conf::getDebug())
                echo $e->getMessage(); // affiche un message d'erreur
            else
                echo "une erreur est survenue <a href='index.php> retour à la page d\'accueil</a>";
            die();

        }
        return $req_prep->fetch();
    }

    // verifie si un element existe dans une table
    public static function exist ($key){
        $sql = 'SELECT *
                FROM '.static::$table.'
                WHERE '.static::$primary.'=:key';
        try{
            $req_prep =  Model::$pdo->prepare($sql);
            $req_prep->bindParam(':key', $key);
        }catch (PDOException $e){
            if(Conf::getDebug())
                echo $e->getMessage(); // affiche un message d'erreur
            else
                echo "une erreur est survenue <a href='index.php> retour à la page d\'accueil</a>";
            die();
        }
        $res = true;
        if($req_prep == null){
            // si le resultat de la requete est vide
            $res = false;
        }
        return $res;

    }


}

Model::Init();

?>
