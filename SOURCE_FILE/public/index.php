<?php
session_start();
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR .'..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'veiw' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);
// intializing configration files
require_once ROOT_PATH . 'src/intializer.php';
// seting up the database
require_once ROOT_PATH . 'src/database.php';
require_once ROOT_PATH . 'src/urls.php';
// var_dump($urls);
// geting url from the user
$sectionTo = $_GET['seo_name'] ?? $_POST['seo_name'] ?? 'home';
// calling the routing class to get the route

// check acceptable urls
if(!in_array($sectionTo, $urls)){
    include VIEW_PATH . 'status/404.html';
    die();
}
 
$router = new Router($dbc);
$router->findBy(['pretty_url'=>$sectionTo], '');
$action = ($router->action ?? '') != '' ? $router->action : 'default';
$moduleName = $router->module . 'Controller';
$templateName = $router->template;

if($router->location){
    $controllerFile = MODULE_PATH . $router->module . '/'. $router->location . '/controllers/' . $moduleName . '.php'; 
}
else{
    $controllerFile = MODULE_PATH . $router->module . '/controllers/' . $moduleName . '.php';
}

if(file_exists($controllerFile)){
    include $controllerFile;
    $controller = new $moduleName();
    $controller->dbc = $dbc;
    $controller->template = new Template('/layout/'.$templateName);
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}





