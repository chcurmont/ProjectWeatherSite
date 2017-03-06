<?php
/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 06/03/2017
 * Time: 03:51
 */

namespace DAL;


class WeatherAPIGateway
{
    private $BASE_URL;
    public function __construct($URL)
    {
        $this->BASE_URL = $URL;
    }

    public function lireAPI(){
        $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="clermont-ferrand, au")';
        $yql_query_url = $this->BASE_URL."?q=".urlencode($yql_query)."&format=json";

        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $json = curl_exec($session);

        return json_decode($json);
    }
}