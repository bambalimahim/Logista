<?php
require_once "lib/includes.php";
require_once "classes/BDD.php";

if(!isset($_POST["stats"])){
	setFlash('Veuillez choisir au moins un critere','danger');
	header('location: resultats.php');
	die();
}
$informations = getSearchResults();
$formStat = $_POST["stats"];
$valChamps = array();
echo "<pre>";
$resArray = BDD::requeteStatEtudiant($db, $formStat, $informations, 0, $valChamps) ;
$_SESSION['resArray'] = $resArray;
$_SESSION['formStat'] = $formStat;
$tableau = array();
//var_dump(array_keys(BDD::requeteStatEtudiant($db, $formStat, $informations, 0, $formStat, $valChamps)));
$champs = array();
$elt=0;
BDD::recupererValStat($resArray,$resArray,$formStat,0,$champs,$elt, $tableau) ;

for ($i=0 ;$i<count($tableau); $i++) {
    $champsGraph[$i] = $tableau[$i][0][0];
    $data[$i]=$tableau[$i][1];
    for ($j=1; $j<count($formStat); $j++)
        $champsGraph[$i].="/".$tableau[$i][0][$j];
}
//var_dump($tableau);
for ($i=0;$i<count($tableau);$i++) {
    $champsdata[$i]=$tableau[$i][0];
}
//var_dump($tableau);
$_SESSION['tableau'] = $tableau;
$_SESSION['data'] = $data;
$_SESSION['champsData'] = $champsdata;
$_SESSION['champsGraph'] = $champsGraph;
$totalRes=0;
for ($i=0;$i<count($data);$i++)
    $totalRes+=$data[$i];
$_SESSION['totalRes'] = $totalRes;
//var_dump($tableau);
header("location:statistiques.php");
die();

?>
