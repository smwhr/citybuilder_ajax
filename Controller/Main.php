<?php

namespace Controller;

use \Library\Request;

class Main extends General{

  function indexAction(Request $request){

    $insee = new \Iso9005\Geography\Norms\InseeCode();
    include("views/front/index.html.php");

  }
}