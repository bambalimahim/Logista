<?php
require_once "lib/includes.php";
require_once  "classes/BDD.php";

class DataCircGraph {
    public $name;
    public $colorByPoint = true;
    public $data;

    public function __construct($name, $data) {
        $this->name=$name;
        $this->data=$data;
    }
}

$donnee = array();
/*
echo "<pre>";
var_dump($_SESSION['champsData']);
echo "</pre>";
*/
$total=0;
for ($i=0; $i<count($_SESSION['data']); $i++){
    $total+=$_SESSION['data'][$i];
}
for ($i=0; $i<count($_SESSION['data']); $i++){

    $name="".$_SESSION['champsData'][$i][0];
    for ($j=1; $j<count($_SESSION['champsData'][$i]); $j++)
        $name .= "/".$_SESSION['champsData'][$i][$j];
    $donnee[$i]['name']=$name;
    $donnee[$i]['y']=$_SESSION['data'][$i];
    if ($i==0){
        $donnee[$i]['selected']=true;
        $donnee[$i]['sliced']=true;
    }


}
$data[0] = new DataCircGraph("Etudiants", $donnee);

echo json_encode($data);
