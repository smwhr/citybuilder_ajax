<?php


class MainController{

  function indexAction(Request $request){

    include("views/front/index.html.php");

  }
}