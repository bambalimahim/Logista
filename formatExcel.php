<?php

require_once "lib/includes.php";
require_once "classes/BDD.php";
require_once 'classes/PHPExcel.php';
require_once 'classes/PHPExcel/IOFactory.php';
require_once 'classes/PHPExcel/Writer/Excel2007.php';
if (!isset($_SESSION['resArray'])) {
    header("location: resultats.php");
    die();
}
$resArray = $_SESSION['resArray'];
$formStat = $_SESSION['formStat'];
$totalRes = $_SESSION['totalRes'];
$tab = $_SESSION['data'];
$champ = $_SESSION['champsGraph'];
$tableau = $_SESSION['tableau'];

// création des objets de base et initialisation des informations d'entête



    // création des objets de base et initialisation des informations d'entête

    $classeur = new PHPExcel;

    $classeur->getProperties()->setCreator("Annie Gagnon");

    $classeur->setActiveSheetIndex(0);

    $feuille=$classeur->getActiveSheet();

 

    // ajout des données dans la feuille de calcul

    $feuille->setTitle('Nom affiché dans l\'onglet');

    
    // for ($i=0; $i < count($champ); $i++) { 
    //     $feuille->setCellValueByColumnAndRow(0, $i , $champ[$i]);
    //     $feuille->setCellValueByColumnAndRow(10, $i, $tab[$i]);    
    // }
    $alphabet = array("A", "B","C","D","E","F","G", "H","I","J","K","L",
        "M", "N","O","P","Q","R","S", "T","U","V","W","X","Y","Z");
    $entete = 0;
    for ($i=0; $i < count($formStat); $i++) {
        $feuille->getColumnDimension($alphabet[$i])->setWidth(40);
        $feuille->setCellValueByColumnAndRow($entete, 1 , $formStat[$i]);
        $entete ++;
    }
    $feuille->setCellValueByColumnAndRow($entete, 1 , 'Totaux');
    $l = 0;
    $s = 1;
    $index = 1;
    $col = 2;
    for ($i=1; $i < count($tableau[0][0]); $i++) {
        $infoCourant = $tableau[0][0][$l];
        $valC = $tableau[0][0][$s];
        for ($j=0; $j < count($tableau); $j++) {
           $feuille->getColumnDimension($alphabet[$index])->setWidth(40);
            if ($i == (count($tableau[0][0]) - 1)) {
                $feuille->setCellValueByColumnAndRow($index+1, $col,$tab[$j]);
            }
            if ($infoCourant == $tableau[$j][0][$i-1]) {
                    $feuille->setCellValueByColumnAndRow($index,$col,$tableau[$j][0][$i]);
                    $valC = $tableau[$j][0][$i];
                    $col ++;
            }else{
                $infoCourant = $tableau[$j][0][$i-1];
                $valC = $tableau[$j][0][$i];
                $feuille->setCellValueByColumnAndRow($index, $col,$tableau[$j][0][$i]);
                $col ++;
            }
        }
        $l ++;
        $s ++;
        $col = 2;
        $index ++;
    }
    $col = 2;
    $feuille->getColumnDimension("A")->setWidth(40);
    for ($j=0; $j < count($tableau); $j++) {
        $feuille->setCellValueByColumnAndRow(0,$col,$tableau[$j][0][0]);
        $col ++;
    }
    
    //$feuille->SetCellValue('A2', 'Il est aussi possible d\'utiliser la notation LettreChiffre (ex : A2)');

 

    // envoi du fichier au navigateur

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 

    header('Content-Disposition: attachment;filename="resultat.xlsx"');

    header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createWriter($classeur, 'Excel2007'); 

    $writer->save('php://output');

    header("location:resultat.php");

?>
 