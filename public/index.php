<?php
  chdir("..");

  //on initialise la session
  session_start();

  require_once("vendor/autoload.php");

  $insee = new \Iso9005\Geography\Norms\ZipCode();

  // //on initialise l'autoloader
  // function initiation_autoload($classname){

  //   // Iso9005\Geography\Norms\InseeCode
  //   $components = explode('\\',$classname);
  //   //["Iso9005","Geography","Norms", "InseeCode"]
  //   $rootNS = reset($components);
  //   //"Iso9005"
  //   $simpleClassName = end($components);
  //   //"InseeCode"

  //   if($rootNS == "Iso9005"){
  //     //follow psr4 rules
  //     require_once("Library/ISO-9005/".$simpleClassName.".php");
  //   }

  //   if($rootNS == "Zend"){
  //     //"Zend_Services_Agents_SOAP_WSDLAgent"
  //     //follow psr4 rules
  //     $path = str_replace("_", "/", $classname);
  //     require_once("ZendLib/".$path.".php");
  //   }
    
  //   // else follow psr0 rules
  //   $path = str_replace("\\", "/", $classname);
  //   require_once($path.".php");

  // }
  // spl_autoload_register("initiation_autoload");

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

