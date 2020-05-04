<?php


class Request{
  private $post_params;
  private $get_params;
  private $uri;
  private $method;


  public function __construct(
              $uri,
              $method,
              $get_params, 
              $post_params)
  {
    $this->uri = $uri;
    $this->method = $method;
    $this->post_params = $post_params;
    $this->get_params = $get_params;
  }

  public function getPath(){
    $path = parse_url($this->uri, PHP_URL_PATH);
    return $path;
  }

  public function isPost(){
    return $this->method == "POST";
  }

  public function get($param){
    if($this->isPost()){
      return $this->post_params[$param];
    }else{
      return $this->get_params[$param];
    }
  }



}