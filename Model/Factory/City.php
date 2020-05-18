<?php 
namespace Model\Factory;

class City extends AbstractFactory{

  public function get_all(){
    $q = "SELECT * FROM cities;";
    $stmt = $this->pdo->query($q);
    $recettes = $stmt->fetchAll(PDO::FETCH_CLASS, "City");


    return $recettes;
  }

  public function add_one($name){

    $q = "INSERT INTO cities SET name = :name";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":name" => $name]);
    $id = $this->pdo->lastInsertId();

    return $id;

  }

  public function get_one($id){
    $q = "SELECT * FROM cities WHERE id = :id";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":id" => $id]);
    $recette = $stmt->fetchObject("Recette");
    return $recette;
  }
}