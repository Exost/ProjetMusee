<?php
session_start();// on démarre toujours les session sur les page
require_once("{$ROOT}{$DS}model{$DS}modelMembre.php");
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 19/11/15
 * Time: 16:46
 */

$erreur =''; // une idée pour afficher l'erreur sur la page
$layout = 'visiteurView';
switch($action){
    case 'create':
        $view="Create";
        $control='Membre';
        break;
    case 'created':

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
                $tab = array($log,$nom,$prenom,$mail,$sexe,$passwd);
                modelMembre::insert($tab);

                //insertion dans la base de donne
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
            $mdp = sha1($_POST['mdp']);

            if($membre['mot_de_passe'] ==$mdp ){ // verification de la concordance des mot de passe
                // alors l'utilisateur est connecté

                $_SESSION['login'] = $membre['login'];
                $layout='membreView';
                echo "{$_SESSION['login']}";
                //ouverture de la partie membre 'a voir comment faire'
            }else{
                $control='Membre';
                $view = 'LogIn';
                $erreur='Mot de passe incorrect';
            }
        }else{
            $control='Membre';
            $view = 'LogIn';
            $erreur='Login inexistant';
        }

        break;

}
require("{$ROOT}{$DS}view{$DS}{$layout}.php");
