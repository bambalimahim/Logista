<?php
require_once "classes/BDD.php";
require_once "lib/includes.php";

if (!isset($_SESSION['lieux'])) {
    setFlash('Erreur lors de la geolocalisation ','danger');
    header("location: resultats.php");
    die();
}
$lieux = $_SESSION['lieux'];

for($i=0;$i<count($lieux);$i++) {
    // Google Maps Geocoder
    $geocoder = "http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false";
    $lieux[$i]['location']['lat']=0;
    $lieux[$i]['location']['lng']=0;
    $adresse = $lieux[$i]['lieuNaiss'];
    $adresse .= ','.$lieux[$i]['paysNaiss'];
    $lieux[$i]['location']['lat'] = 0;
    $lieux[$i]['location']['lng'] = 0;
    BDD::location($db, $lieux[$i]['paysNaiss'], $lieux[$i]['lieuNaiss'], $lieux[$i]['location']['lat'], $lieux[$i]['location']['lng']);
    if ($lieux[$i]['location']['lat']==0.0 AND $lieux[$i]['location']['lng']==0.0) {
        // Requête envoyée à l'API Geocoding
        $query = sprintf($geocoder, urlencode($adresse));

        $result = json_decode(file_get_contents($query));
        //var_dump($query);
        //var_dump($result);
        if (count($result->results)>0) {
            $json = $result->results[0];
            if ($json){
                $lieux[$i]['location']['lat'] = floatval((string) $json->geometry->location->lat);
                $lieux[$i]['location']['lng'] = floatval((string) $json->geometry->location->lng);
                BDD::insertLocation($db, $lieux[$i]['paysNaiss'], $lieux[$i]['lieuNaiss'], $lieux[$i]['location']['lat'], $lieux[$i]['location']['lng']);
            }
        }
    }
    $lieux[$i]['nbLieu'] = (int)$lieux[$i]['nbLieu'];

}
$lieux = json_encode($lieux);
$_SESSION['locationMap'] = $lieux;
//echo $lieux;
//var_dump($lieux);
//echo "</pre>";
header("location: geolocalisation.php");
