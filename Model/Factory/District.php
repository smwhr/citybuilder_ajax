<?php 

class DistrictFactory{

  public function add_one_to_city(  $name,
                                    $city_id 
                                  ){
    $q = "INSERT INTO districts SET 
                            name = :name,
                            city = :city_id
                    ";
    $stmt = $this->pdo->prepare($q);
    $stmt->execute([":name" => $name,
                    ":city_id" => $city_id
                    ]);
    $id = $this->pdo->lastInsertId();
    return $id;
  }

}