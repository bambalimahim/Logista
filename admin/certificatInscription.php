<?php
require_once '../lib/includes.php';
require_once 'traitementDocument.php';
//require_once '../partials/header.php';

$choixEtud = explode(',', $_POST['choixEtud']);
$resultats = getSearchResults();
if(isset($choixEtud)){ //sera vrai si au moins un checkbox a Ã©tÃ© cochÃ©
    $j=0;
    for($i=0; $i<count($choixEtud);$j++){
        if(intval($choixEtud[$i])==$j){
            $i++;
            $attestResults[]=$resultats[$j]; //recuperer les resultats de recherche
        }
    }
}
else
    header('location: ../resultats.php');

$content = "";
foreach($attestResults as $result){
	//recuperer les infos dynamique du document pour chaque etudiant , recuperer les checkboxes cochés
	$sexe=$result['sexe'];
	if ($sexe=='Masculin') {
	       $situation='Monsieur';
	       $etud='Etudiant';
         $ne='né';
        $inscrit ='inscrit';
	}
	else if ($sexe=='Feminin') {
	        $situation='Mademoiselle';
			$etud='Etudiante';
      $ne='née';
        $inscrit ='inscrite';
	}
	$prenom=$result['prenom'];
	$nom=$result['nom'];
	$dateNaiss=$result['dateNaiss'];
	$dateNaissAct=XX_Moi_XXXX($dateNaiss);  //date  de naissance sous format Jour Mois Année
	$lieuNaiss=$result['lieuNaiss'];
	$paysNaiss=$result['paysNaiss'];
	$niveau=$result['niveau'];
	$formation=$result['formation'];
  $option=$result['nomOption'];
	$annee=$result['annee'];
	$date=date('Y-m-d');
    $dateActuel = XX_Moi_XXXX($date);  //date  du jour sous format Jour Mois Année
	
	//recuperer le contenu du document word 
ob_start();
	
?>
<style type="text/css">
    <!--
    div.entete {
        width: 70mm;
    }
    .center {
        text-align: center;
    }

    div.divLogo {
        text-align: center;
    }
    img.logo {
        width: 60px;
        height: 60px;
        border: none;
    }
    div.size8 {
        font-size: 8pt;
    }
    div.size9 {
        font-size: 9pt;
    }
    .size10 {
        font-size:  10pt;
    }
    .size11 {
        font-size:  11pt;
    }
    .size12 {
         font-size:  12pt;
    }
    .size13 {
        font-size:  13pt;
    }
    .size14 {
        font-size:  14pt;
    }
    .size18 {
        font-size:  18pt;
    }
    .size20 {
        font-size:  20pt;
    }
    .arial {
        font-family: arial;
    }
    .algerian {
        font-family: algerian;

    }
    .tnr {
        font-family: times;
    }
    .bold {
        font-weight: bold;
    }
    
    div.gris-clair{
        color: rgb(223,223,223);
    }

    -->
</style>
<page>
    <div class="entete">
        <div class="arial center size8 bold">UNIVERSITE CHEIKH ANTA DIOP DE DAKAR</div>
        <div class="divLogo"><img class="logo" src="../img/logo_ucad.png"></div>
        <div class="arial center size11 bold">École Supérieure Polytechnique</div>
        <div class="arial center size9 bold">SERVICE DE LA SCOLARITE</div>
        <div class="arial center size8 bold">B.P. 5085 - DAKAR-FANN</div>
        <div class="arial center size8 bold">Tel (221) 33 864 51 96 - Fax (221) 33 825 55 94</div>
        <div class="arial center size8 bold">
            <table style="margin: auto">
                <tr>
                    <td>E-mail :</td>
                    <td style="color: blue; text-decoration: underline">scolarite.esp@ucad.edu.sn</td>
                </tr>
            </table>
        </div>
        <div class="arial center size8"></div>
        <div class="arial center size8"></div>
        <div class="arial center size8"></div>
        <div class="arial center size8"></div>
    </div>
    <div class="center">
        <table style="margin: auto">
            <tr>
                <td class="algerian size20" style="background-color: rgb(223,223,233); border-bottom: #000 solid; border-right: #000 solid;">CERTIFICAT D'INSCRIPTION</td>
            </tr>
        </table>
    </div>
    <div class="algerian size20"></div>
    <div class="algerian size18"></div>
    <div class="tnr size10"></div>
    <table>
        <tr>
            <td class="tnr size14">Je certifie que</td>
        </tr>
    </table>
    <div class="tnr size14"></div>
    <table>
        <tr>
            <td class="tnr size14"><?php echo $situation; ?> </td>
            <td class="tnr size14 bold"><?php echo $prenom; ?> <?php echo $nom; ?></td>
        </tr>
    </table>
    <div class="tnr size14"></div>
    <table>
        <tr>
            <td class="tnr size14"><?php echo $ne; ?> le <?php echo $dateNaissAct; ?> à <?php echo $lieuNaiss; ?> (<?php echo $paysNaiss; ?>)</td>
        </tr>
    </table>
    <div class="tnr size14"></div>
    <table style="border-collapse: collapse ;" border="0">
        <tr>
            <td class="tnr size14"><?php echo $etud; ?> en&nbsp;</td>
            <td class="tnr size14 bold"> <?php echo $niveau; ?></td>
            <td class="tnr size14 bold"> <?php echo $formation; ?></td>
        </tr>
    </table>
    <div class="tnr size14"></div>
    <table style="border-collapse: collapse ;" border="0">
        <tr>
            <td class="tnr size14">Spécialité :</td>
            <td class="tnr size14 bold"><?php echo $option; ?></td>
        </tr>
    </table>
    <div class="tnr size12"></div>
    <div class="tnr size12"></div>
    <table>
        <tr>
            <td class="tnr size14 bold"> est régulièrement <?= $inscrit ?> en année académique <?php echo $annee; ?>.</td>
        </tr>
    </table>
    <div class="tnr size12"></div>
    <div class="tnr size12"></div>
    <table>
        <tr>
            <td class="tnr size14">Le présent certificat est délivré pour servir et valoir ce que de droit.</td>
        </tr>
    </table>
    <div class="tnr size14"></div>
    <div class="tnr size14"></div>
    <div class="tnr size14"></div>
    <div class="tnr size14"></div>
    <div class="tnr size13 center" style="padding-left: 77.5mm">Fait à Dakar, le <?php echo $dateActuel; ?></div>
    <div class="tnr size12"></div>
    <div class="tnr size12"></div>
    <div class="tnr size12"></div>
    <div class="tnr size12 bold center" style="padding-left: 77.5mm">Le Chef des Services Administratifs</div>
</page>

<?php

    $content .= ob_get_clean();
    }  //end foreach
    $content = htmlspecialchars_decode(htmlentities($content, ENT_NOQUOTES, "UTF-8"));
    ob_end_clean();

    require_once('../classes/html2pdf/vendor/autoload.php');
    require_once("../classes/html2pdf/html2pdf.class.php");
    try {
        $pdf = new HTML2PDF('P','A4','fr',false,'ISO-8859-15',array(25,15,25,25));
        $pdf->addFont('algerian','', '../fonts/algerian.php');
        $pdf->addFont('ariaal','', '../fonts/ariaal.php');
        $pdf->writeHTML($content);
        $pdf->Output('test1.pdf');
    } catch (HTML2PDF_exception $e) {
        die($e);
    }  
?>
