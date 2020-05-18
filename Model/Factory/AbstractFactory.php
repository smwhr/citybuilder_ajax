<?php
namespace Model\Factory;


abstract class AbstractFactory {

  public $pdo;

  public function __construct(\PDO $pdo){
    $this->pdo = $pdo;
  }

}