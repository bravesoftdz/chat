<?php

namespace Dykyi;

$pos              = strripos($_SERVER['DOCUMENT_ROOT'], '/');
$documentRootPath = mb_strcut($_SERVER['DOCUMENT_ROOT'], 0, $pos);
//$documentRootPath = $_SERVER['DOCUMENT_ROOT'];
define('ROOT_DIR', $documentRootPath);

$_ENV = 'dev';

require_once '../vendor/autoload.php';
//
require_once '../app/Common/Config.php';
require_once '../app/Common/Database.php';
require_once '../app/Controller.php';
require_once '../app/Controller/ControllerLogin.php';
require_once '../app/Controller/ControllerIndex.php';
require_once '../app/Model.php';
require_once '../app/Model/UsersModel.php';
require_once '../app/Model/FriendsModel.php';
require_once '../app/Common/User.php';
require_once '../app/Common/Login.php';
require_once '../app/Common/SignUp.php';

session_start();

$uri = substr($_SERVER['REQUEST_URI'], 1);
$pos = strpos($uri, "?");
if ($pos > 0) {
    $uri = substr($uri, 0, $pos);
}

$uri    = explode('/', $uri);
$route  = empty($uri[0]) ? 'index' : $uri[0];
$action = empty($uri[1]) ? 'index' : $uri[1];

$className = __NAMESPACE__ . "\\Controller\\Controller" . ucfirst($route);
$class     = new $className();
$class->setAction($action);
$class->setRoute($route);
$class->$action();
exit();

