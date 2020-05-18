<?php

namespace Controller;

use \Library\Request;
use \Model\Factory\City as CityFactory;
use \Model\Factory\District as DistrictFactory;

class City extends Api{

  public function createAction(Request $request){

    $city_name = $request->get("city_name");

    $cityFactory = new CityFactory($this->pdo);
    $new_id = $cityFactory->add_one( 
                                  $city_name
                                  );

    return $this->response(["result" => "created",
                            "city" => $city_name,
                            "id"   => $new_id
                            ], 201);
    
  }

  public function adddistrictAction(Request $request){

    $district_name = $request->get("district_name");
    $city_id = $request->get("city_id");

    //simulation
    $districtFactory = new DistrictFactory($this->pdo);
    $district_id = $districtFactory->add_one_to_city($district_name, $city_id);

    return $this->response(
      ["result" => "added",
       "district" => $district_name,
       "id" => $district_id,
      ], 201);

  }

}