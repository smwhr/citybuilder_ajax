<?php
  //on initialise la session
  session_start();

  //on initialise l'autoloader
  function initiation_autoload($classname){
    
    $path = str_replace("\\", "/", $classname);
    require_once($path.".php");

  }
  spl_autoload_register("initiation_autoload");

  chdir("..");

  $request = new \Library\Request($_SERVER["REQUEST_URI"], 
                         $_SERVER["REQUEST_METHOD"], 
                         $_GET, 
                         $_POST);

try{
  // est-ce que la route exite ?
  $path = $request->getPath();

  @list($null, $controller, $action) = explode("/", $path);
  $controllerName = !empty($controller) ? $controller : "Main";
  $controllerName = ucfirst($controllerName);
  $controllerName = "Controller\\".$controllerName;
  $actionName = $action ?? "index";

  $controller = new $controllerName();

  $methodName = $actionName."Action";
  $controller->$methodName($request);

}catch(Exception $e){
  $message = $e->getMessage();
  include("views/error.html.php");
}

