<?php
  chdir("..");

  //on initialise la session
  session_start();

  require_once("vendor/autoload.php");

  //on initialise la connexion à la bdd
  require_once("config/secret.php");

  $pdo = new PDO('mysql:dbname='.$secret["db"]["dbname"].';host='.$secret["db"]["host"].";charset=utf8mb4", $secret["db"]["username"], $secret["db"]['password']);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  //on setup la requete
  $request = new \Library\Request($_SERVER["REQUEST_URI"], 
                         $_SERVER["REQUEST_METHOD"], 
                         $_GET, 
                         $_POST);

try{
  $path = $request->getPath();

  @list($null, $controller, $action) = explode("/", $path);
  $controllerName = !empty($controller) ? $controller : "Main";
  $controllerName = ucfirst($controllerName);
  $controllerName = "Controller\\".$controllerName;
  $actionName = $action ?? "index";

  $controller = new $controllerName($pdo);

  $methodName = $actionName."Action";
  $controller->$methodName($request);

}catch(Exception $e){
  $message = $e->getMessage();
  include("views/error.html.php");
}

