<?php
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 21/11/15
 * Time: 23:30
 */
$action = $_GET['action'];
if(isset($_SESSION['login'])){ // s'il existe une session alors
    switch($action){
        case 'post':
            //poster un document
            break;

    }
}else{
    //impossible d'acceder à l'espace membre
}