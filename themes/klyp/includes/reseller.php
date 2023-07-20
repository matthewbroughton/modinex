<?php
/*
* Get Google Maps Latitude & Longtitude by address
* @params string Location Address
* @return array latitude and longitude 
*/
function get_lat_lng($address)
{
    $results = array();
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address=' . rawurlencode($address) . '&key=' . get_field('google_map_api_key', 'option'));
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
    $result_json = curl_exec($curl);
    $result_arr = json_decode($result_json, true);
    curl_close ($curl);
    $results['lat'] = $result_arr['results'][0]['geometry']['location']['lat'];
    $results['lng'] = $result_arr['results'][0]['geometry']['location']['lng'];

    return $results;
}
?>