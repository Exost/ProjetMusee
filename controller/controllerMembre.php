<?php

require_once("{$ROOT}{$DS}model{$DS}modelMembre.php");
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 19/11/15
 * Time: 16:46
 */
$action = $_GET['action'];
switch($action){
    case 'create':
        $view="Create";
        break;
    case 'login':
        $view= 'LogIn'; //connexion
        break;
    case 'created':
        $log = $_POST['login'];
        if(modelMembre::exist($log)){
            // si l'element existe deja
            $view = "create";
        }
        break;

}
require("{$ROOT}{$DS}view{$DS}view.php");