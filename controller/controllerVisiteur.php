<?php

require_once("{$ROOT}{$DS}model{$DS}modelMembre.php");
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 19/11/15
 * Time: 16:46
 */
$action = $_GET['action'];
$erreur =''; // une idée pour afficher l'erreur sur la page
switch($action){
    case 'create':
        $view="Create";
        $control='Membre';
        break;
    case 'created':
        $log = $_POST['login'];
        if(modelMembre::exist($log)){
            // si l'element existe deja
            $view = "Create";
            $control='Membre';
            $erreur="ce login existe déja veuillez en choisir un autre";
        }
        else{
            if($_POST['mdp'] != $_POST['mdp2']){
                $view = "Create";
                $control='Membre';
                $erreur='mot de passe different';
            }else{
                $log =$_POST['login'];
                $nom =$_POST['nom'];
                $prenom =$_POST['prenom'];
                $mail = $_POST['email'];
                $sexe = $_POST['sexe'];
                $passwd= sha1($_POST['mdp']); // mot de passe codé --> sécurite
                // $membre = new modelMembre();
                //insertion dans la base de donne
            }
        }
        break;
    case 'login':
        $view= 'LogIn'; //connexion
        $control='Membre';
        break;
    case 'logged':
        $key = $_POST['login'];
        if(modelMembre::exist($key)){
            $membre = modelMembre::select($key);
            $mdp =shal($_POST['mdp']);

            if($membre['mot_de_passe'] =$mdp ){ // verification de la concordance des mot de passe
                // alors l'utilisateur est connecté
                session_start();
                $_SESSION['login'] = $membre['login'];
                //ouverture de la partie membre 'a voir comment faire'

            }
        }else{
            $control='Membre';
            $view = 'LogIn';
            $erreur='Login inexistant';
        }

        break;

}
require("{$ROOT}{$DS}view{$DS}view.php");
