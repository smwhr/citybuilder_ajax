<?php

namespace Controller;

use \Library\Request;

class Main{

  function indexAction(Request $request){
    include("views/front/index.html.php");

  }
}