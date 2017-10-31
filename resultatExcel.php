<?php
	require_once "lib/includes.php";
	require_once "classes/BDD.php";
	require_once 'classes/PHPExcel.php';
	require_once 'classes/PHPExcel/IOFactory.php';
	require_once 'classes/PHPExcel/Writer/Excel2007.php';
	/*echo "<pre>";
	var_dump($_SESSION['resArray']);
	echo "</pre>";
	die();*/
	if (!isset($_SESSION['searchReasults'])) {
	    header("location: resultats.php");
	    die();
	}

	$resultats = getSearchResults();
	 //echo "<pre>";
	 	//var_dump($resultats);die();
	 //echo "</pre>";

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
    
    // boucle pour aficher les départements

    // for ($d=0; $d < count($tableau); $d++) { 
        
    // }
    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        )
    );
    $index = 2;
    $champBase = array(
		"idEtudiant","nom","prenom","cni","matricule","sexe","civilite","dateNaiss","paysNaiss", "nationalite","lieuNaiss","numTel",
		"serieBac","annee","nomDept","nomOption","formation","niveau","nature","priseEnCharge","resultat");
    $alphabet = array("A", "B","C","D","E","F","G", "H","I","J","K","L",
    	"M", "N","O","P","Q","R","S", "T","U","V","W","X","Y","Z");

	for ($i=0; $i < count($resultats); $i++) { 
		for ($j=0; $j < count($resultats[$i]); $j++) { 
			if ($i == (count($resultats)-1)) {
				$feuille->setCellValueByColumnAndRow($j, 1 , $champBase[$j]);
			}
			if ($champBase[$j] == "numTel" || $champBase[$j] == "niveau") {
				$feuille->getStyle($alphabet[$j]."1:".$alphabet[$j]."256")->applyFromArray($style);
			}
			if($champBase[$j]=='cni'){
				$feuille->setCellValueByColumnAndRow($j, $index , strval($resultats[$i][$champBase[$j]]) );
				$feuille->getStyle($alphabet[$j]."1:".$alphabet[$j]."256")->applyFromArray($style);
			}
			else{
				$feuille->setCellValueByColumnAndRow($j, $index , $resultats[$i][$champBase[$j]]);
			}
			if ($champBase[$j] == "annee" || $champBase[$j] == "dateNaiss" || $champBase[$j] == "sexe" || $champBase[$j] == "niveau" || $champBase[$j] == "nature") {
				$feuille->getColumnDimension($alphabet[$j])->setWidth(15);
			}elseif ($champBase[$j] == "nomOption") {
				$feuille->getColumnDimension($alphabet[$j])->setWidth(40);
			}
			else
				$feuille->getColumnDimension($alphabet[$j])->setWidth(25);
		}
		$index ++;
	}
    //$feuille->getColumnDimension('A')->setWidth(count($tableau));
    //$feuille->SetCellValue('A2', 'Il est aussi possible d\'utiliser la notation LettreChiffre (ex : A2)');

 

    // envoi du fichier au navigateur

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 

    header('Content-Disposition: attachment;filename="nomfichier.xls"');

    header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createWriter($classeur, 'Excel2007');

    $writer->save('php://output');


?>
