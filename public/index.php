<?php
  //on initialise la session
  session_start();

  //on initialise l'autoloader
  function initiation_autoload($classname){
    
    //TODO
    //cette fonction
    if(strpos($classname, "Controller")){
      require_once("controllers/".$classname.".php");
    }else if(strpos($classname, "Factory")){
      require_once("models/factory/".$classname.".php");
    }else if(in_array($classname, ["Request"])){
      require_once("library/".$classname.".php");
    }else{
      require_once("models/".$classname.".php");
    }

  }
  spl_autoload_register("initiation_autoload");

  chdir("..");

  //require_once("library/Request.php");

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

  //require_once("controllers/".$controllerName.".php");
  $controller = new $controllerName();

  $methodName = $actionName."Action";
  $controller->$methodName($request);

}catch(Exception $e){
  $message = $e->getMessage();
  include("views/error.html.php");
}

