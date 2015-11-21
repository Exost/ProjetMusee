<?php
/**
 * Created by PhpStorm.
 * User: enzo
 * Date: 19/11/15
 * Time: 13:58
 */

$ROOT = __DIR__;  /*  Correspond à /var/www/html/private/TD4
                               permet de le rendre portable
                      */

// DS contient le slash des chemins de fichiers, c'est-à-dire '/' sur Linux et '\' sur Windows
$DS = DIRECTORY_SEPARATOR;

$controller = $_GET['controller'];
switch($controller){
    case 'membre':
        require("{$ROOT}{$DS}controller{$DS}controllerMembre.php");
        break;
    case 'document':
        break;
}