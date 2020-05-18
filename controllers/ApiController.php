<?php

class ApiController{
  
  public function response($data, $code=200){
    header("Content-type: application/json");
    http_response_code($code);
    echo json_encode($data);
    sleep(1);

    exit;
  }
}