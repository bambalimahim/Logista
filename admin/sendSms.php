<?php
require_once '../lib/includes.php';
$choixEtud = explode(',', $_POST['choixEtud1']);
$resultats = getSearchResults();
if(isset($choixEtud)){ //sera vrai si au moins un checkbox a Ã©tÃ© cochÃ©
    $j=0;
    for($i=0; $i<count($choixEtud);$j++){
        if(intval($choixEtud[$i])==$j){
            $i++;
            $etuds[]=$resultats[$j]; //recuperer les resultats de recherche
        }
    }
}
else{
    header('location: ../resultats.php');
}
/*
echo "<pre>";
//var_dump($_POST['msgObject']);
//var_dump($_POST['msgContent']);
var_dump($etuds);
echo "</pre>";
*/



/* Envoi messges */

//I get the osms class here
require '../classes/osms/vendor/ismaeltoe/osms/src/Osms.php';
use \Osms\Osms;

$config = array(
    'clientId' => 'z6LDTtinFAxRcnO3dMvuVQRvT8lyAm95',
    'clientSecret' => 'ycP8bZooA4sc450Y'
);

$osms = new Osms($config);

//$osms->setVerifyPeerSSL(false);

$response = $osms->getTokenFromConsumerKey();


$config2 = array(
    'token' => $response['access_token']
);

$osms1 = new Osms($config2);

//$osms1->setVerifyPeerSSL(false);

//Bon la faut boucler sur chaque etudiant dans $etuds
foreach ($etuds as $etud){
    $numTel = "tel:+221".preg_replace('/\s+/', '', $etud['numTel']);
    $response2 = $osms1->sendSms(
        $sender='tel:+221773955693',
        //$receiver = "tel:+221".preg_replace('/\s+/', '', $etud['numTel']);
        $receiver='tel:+221771798853',
        $message=$_POST['msgObject'].' : '.$_POST['msgContent'],
        $senderName="Scolarite",
        '$sender',
        '$receiver',
        '$message',
        '$senderName'
    );

    if (empty($response2['error'])) {
        echo "ok\n";
    } else {
        echo $response2['error'];
    }
}

$statusMsgs = array(
    'status' => "Envoye"
);

echo json_encode($statusMsgs);
