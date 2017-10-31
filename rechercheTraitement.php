<?php
//error_reporting(0);
require_once "classes/BDD.php";
require_once "lib/includes.php";
$etud = new Etudiant();
$etudFiltre = new Etudiant();

$etud->nom = isset($_POST['nom'])?$_POST['nom']:'';
$etud->prenom = isset($_POST['prenom'])?$_POST['prenom']:'';
$etud->cni = isset($_POST['cni'])?$_POST['cni']:'';
$etud->sexe = isset($_POST['sexe'])?$_POST['sexe']:array();
$etud->dateNaiss = array($_POST['jourNaiss'], $_POST['moisNaiss'], $_POST['anneeNaiss']);
$etud->paysNaiss = isset($_POST['paysNaiss'])?$_POST['paysNaiss']:array();
$etud->lieuNaiss = isset($_POST['lieuNaiss'])?$_POST['lieuNaiss']:array();
$etud->nationalite = isset($_POST['nationalite'])?$_POST['nationalite']:array();
$etud->numTel = isset($_POST['numTel'])?$_POST['numTel']:'';
$etud->serieBac = isset($_POST['serieBac'])?$_POST['serieBac']:'';

$etudFiltre->nom = isset($_POST['search_param_nom'])?$_POST['search_param_nom']:'';
$etudFiltre->prenom = isset($_POST['search_param_prenom'])?$_POST['search_param_prenom']:'';
$etudFiltre->cni = isset($_POST['search_param_cni'])?$_POST['search_param_cni']:'';
$etudFiltre->dateNaiss = array($_POST['search_param_jourNaiss'], $_POST['search_param_moisNaiss'], $_POST['search_param_anneeNaiss']);
$etudFiltre->numTel = isset($_POST['search_param_numTel'])?$_POST['search_param_numTel']:'';
$etudFiltre->serieBac = isset($_POST['search_param_serieBac'])?$_POST['search_param_serieBac']:'';

$infosEt = new InfosEtudiant();
$infosEtFiltre = new InfosEtudiant();

$infosEt->etudiant = $etud;
$infosEt->civilite = isset($_POST['civilite'])?$_POST['civilite']:array();
$infosEt->annee = isset($_POST['annee'])?$_POST['annee']:array();
$infosEt->formation = isset($_POST['formation'])?$_POST['formation']:array();
$infosEt->niveau = isset($_POST['niveau'])?$_POST['niveau']:array();
$infosEt->nature = isset($_POST['nature'])?$_POST['nature']:array();
$infosEt->priseEnCharge = isset($_POST['priseEnCharge'])?$_POST['priseEnCharge']:array();
$infosEt->nomDept = isset($_POST['nomDept'])?$_POST['nomDept']:array();
$infosEt->nomOption = isset($_POST['nomOption'])?$_POST['nomOption']:array();
$infosEt->resultat = isset($_POST['resultat'])?$_POST['resultat']:array();
$infosEt->matricule = isset($_POST['matricule'])?$_POST['matricule']:'';

$infosEtFiltre->etudiant = $etudFiltre;
$infosEtFiltre->matricule = isset($_POST['search_param_matricule'])?$_POST['search_param_matricule']:'';

//$bdd = BDD::init("logista");
$lieux = [];
$donnees = BDD::requeteEtudiant($db, $infosEt, $infosEtFiltre, $lieux);
$_SESSION['lieux'] = $lieux;
setSearchResults($donnees->fetchAll());

//echo "<pre>";
/*
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
*/
header("location: resultats.php");