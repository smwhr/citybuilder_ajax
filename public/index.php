<?php
  //on initialise la session
  session_start();

  chdir("..");

  require_once("library/Request.php");

  $request = new Request($_SERVER["REQUEST_URI"], 
                         $_SERVER["REQUEST_METHOD"], 
                         $_GET, 
                         $_POST);

try{
  // est-ce que la route exite ?
  $path = $request->getPath();

  @list($null, $controller, $action) = explode("/", $path);
  $controllerName = !empty($controller) ? $controller : "Main";
  $controllerName = ucfirst($controllerName);
  $controllerName .= "Controller";
  $actionName = $action ?? "index";

  require_once("controllers/".$controllerName.".php");
  $controller = new $controllerName();

  $methodName = $actionName."Action";
  $controller->$methodName($request);

}catch(Exception $e){
  $message = $e->getMessage();
  include("views/error.html.php");
}

