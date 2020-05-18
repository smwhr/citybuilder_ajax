<?php

namespace Controller;

use \Library\Request;

class Main extends General{

  function indexAction(Request $request){
    include("views/front/index.html.php");

  }
}