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


    //retrieve weather at that city
    // 1. Une query pour retrouver la ville
    //https://www.metaweather.com/api/location/search/?query={Paris}
    // 2. Une query récupérer le temps
    //https://www.metaweather.com/api/location/{615702}/

    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'https://www.metaweather.com/api/location/search/',
                                ["query" => ["query" => $city_name]]
                            );
    $city_list = json_decode($res->getBody());
    /*
    [
      {
      title: "Paris",
      location_type: "City",
      woeid: 615702,
      latt_long: "48.856930,2.341200"
      }
    ]
    */

    if(count($city_list) > 0 ){
      $city_info = $city_list[0];
      $woeid = $city_info->woeid;
    }

    $res = $client->request('GET', 'https://www.metaweather.com/api/location/'.$woeid.'/');
    $weather_data = json_decode($res->getBody());
    $today = $weather_data->consolidated_weather[0]->weather_state_abbr;
    


    return $this->response(["result" => "created",
                            "city" => $city_name,
                            "id"   => $new_id,
                            "weather" => "https://www.metaweather.com//static/img/weather/png/64/".$today.".png"
                            ], 201);
    
  }

  public function adddistrictAction(Request $request){


    $district_name = $request->get("district_name");
    $city_id = $request->get("city_id");

    //todo secu
    // - verifier que la ville existe
    // - vérifier éventuellement que l'utilisateur a le droit de modifier cette ville

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