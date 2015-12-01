<?php
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 19/11/15
 * Time: 13:58
 */

$ROOT = __DIR__;  /*  Correspond à /var/www/html/....
                               permet de le rendre portable
                      */

// DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur Linux et '\' sur Windows
$DS = DIRECTORY_SEPARATOR;



if ( !isset($_GET['controller']) )
{
    $controller = 'visiteur';
}
else{
    $controller = $_GET['controller'];
}


if ( !isset($_GET['action'] ))
{
    $action="LogIn";
}
else
{
    $action =$_GET['action'];
}

$view = '';



switch($controller){
    case 'visiteur':
        require("{$ROOT}{$DS}controller{$DS}controllerVisiteur.php");
        break;
    case 'document':
        break;
    case 'membre':
        break;




}
?>