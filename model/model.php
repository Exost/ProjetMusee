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

    function delete($para) {
        $sql = "DELETE FROM ".static::$table." WHERE ".static::$primary."=:nom_var";
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->bindParam(":nom_var", $para);
            $req_prep->execute();
            return 0;
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            }
            return -1;
            die();
        }
    }

    function update($tab, $old) {
        $sql = "UPDATE ".static::$table." SET";
        foreach ($tab as $cle => $valeur){
            $sql .=" ".$cle."=:new".$cle.",";
        }
        $sql=rtrim($sql,",");
        $sql.=" WHERE ".static::$primary."=:oldid;";
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $values = array();
            foreach ($tab as $cle => $valeur){
                $values[":new".$cle] = $valeur;
            }
            $values[":oldid"] = $old;
            $req_prep->execute($values);
            $obj = Model::select($tab[static::$primary]);
            return $obj;
        } catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo "PROBLEME"; // affiche un message d'erreur
            }
            return -1;
            die();
        }
    }

    function insert($tab){
        $sql = "INSERT INTO ".static::$table." VALUES(";
        foreach ($tab as $cle => $valeur){
            $sql .=" :".$cle.",";
        }
        $sql=rtrim($sql,",");
        $sql.=");";
        try{
            $req_prep = Model::$pdo->prepare($sql);
            $values = array();
            foreach ($tab as $cle => $valeur){
                $values[":".$cle] = $valeur;
            }
            $req_prep->execute($values);
        }catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href="https://infolimon.iutmontp.univ-montp2.fr/~contremoulinp/TD6/index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }



}

Model::Init();

?>
