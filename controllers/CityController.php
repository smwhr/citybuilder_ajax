<?php

require_once("controllers/ApiController.php");

class CityController extends ApiController{

  public function createAction($request){

    $city_name = $request->get("city_name");

    //simulation d'enregistrement en BDD
    $id = 34;

    return $this->response(["result" => "created",
                            "city" => $city_name,
                            "id"   => $id
                            ], 201);
    
  }

  public function adddistrictAction($request){

    $district_name = $request->get("district_name");
    $city_id = $request->get("city_id");

    //simulation
    // $city = $cityFactory->get($city_id)
    // $district = $districtFactory->add_one($district_name);
    $district_id = 785;

    return $this->response(
      ["result" => "added",
       "district" => $district_name,
       "id" => $district_id,
      ], 201);

  }

}