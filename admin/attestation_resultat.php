<?php
    require_once "../lib/includes.php";
	require_once 'traitementDocument.php';
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

	$content = "<style type=\"text/css\">
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
                        font-size: 10pt;
                    }

                    .size11 {
                        font-size: 11pt;
                    }

                    .size12 {
                        font-size: 12pt;
                    }

                    .size13 {
                        font-size: 13pt;
                    }

                    .size14 {
                        font-size: 14pt;
                    }

                    .size16 {
                        font-size: 18pt;
                    }

                    .size18 {
                        font-size: 18pt;
                    }

                    .size20 {
                        font-size: 20pt;
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

                    div.gris-clair {
                        color: rgb(223, 223, 223);
                    }

                    -->
                </style>";
    //var_dump($attestResults);
    foreach($attestResults as $result){
        //recuperer les infos dynamique du document pour chaque etudiant , recuperer les checkboxes cochés
        $sexe = $result['sexe'];
        if ($sexe == 'Masculin') {
            $situation = 'Monsieur';
            $etud = 'Etudiant';
            $ne = 'Né';
            $admis = 'admis';
        } else if ($sexe == 'Feminin') {
            $situation = 'Mademoiselle';
            $etud = 'Etudiante';
            $ne = 'Née';
            $admis = 'admise';
        }
        $prenom = $result['prenom'];
        $nom = $result['nom'];
        $dateNaiss = $result['dateNaiss'];
        //convertir la date de naissance sous forme Jour/Mois/Annee
        list($year, $month, $day) = explode("-", $dateNaiss);
        $dateNaissAct = $day . '/' . $month . '/' . $year;
        $lieuNaiss = $result['lieuNaiss'];
        $paysNaiss = $result['paysNaiss'];
        $formation = $result['formation'];
        $departement = $result['nomDept'];
        $option = $result['nomOption'];
        $annee = $result['annee'];
		$idEtudiant= $result['idEtudiant'];
		//recuperer la date de déliberation d'un etudiant pour une année académique
		$req=$db->query("SELECT dateDeliberation FROM infosAnnuelles WHERE idEtudiant=$idEtudiant AND annee='$annee'"); 
        $donne = $req->fetch();
		$dateDeliberat= $donne['dateDeliberation'];
		//convertir la date de déliberation sous forme Jour Mois Annee
		$dateDeliberation= XX_Moi_XXXX($dateDeliberat);

        $promotion = substr($annee, count($annee) - 5);  //recuperer la promotion en recupérant les 4 derniéres caractères de l'année académique
        $date = date('Y-m-d');
        $dateActuel = XX_Moi_XXXX($date);  //date  du jour sous format Jour Mois Année
        $resultat = $result['resultat'];
        $niveau = $result['niveau'];
        //vérfier si l'attestation à générer est une attestation de passage ou de réussite
        ob_start();
        if ($resultat == 'Passe') {
            //recuperer les 3 prémières caractères du formation et le convertir en majuscule
            $forma=substr($formation,0,3);
            $format =mb_strtoupper($forma,mb_internal_encoding());
            //recuperer les 1er caractère du niveau
            $niv=substr($niveau,0,1);
            /*
            if((((($format == 'DIC')||($format =='Dic'))||(($format == 'DES')||($format=='Des'))) && ($niv != '3'))
                || ((($format!='Mas')||($format!='MAS')) && ($niv != '2') && ($niv != '3'))
                || (($niv == '2') && ((($dept=='Ges') || ($dept=='GES')) && (($format=='LIC') || ($format=='Lic'))))
            ) {   //générer attestation de passage
                Master 1 GLSI     && ($formation != 'MASTER 1 TR') && ($formation != 'MASTER 2 GLSI') && ($formation != 'MASTER 2 TR')
            */

            if (((($format == 'DIC') || ($formation == 'DES')) && ($niv != '3'))
                || (($format != 'MAS') && ($niv != '2') && ($niv != '3'))
                || (($niv == '2') && ($format == 'LIC'))
            ) {   //générer attestation de passage

            
                ?>

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
                                <td class="algerian size20"
                                    style="background-color: rgb(223,223,233); border-bottom: #000 solid; border-right: #000 solid;">
                                    ATTESTATION DE PASSAGE
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="algerian size20"></div>
                    <div class="algerian size18"></div>
                    <div class="tnr size10"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">Après délibération du Jury en date</td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table style="border-collapse: collapse" border="0">
                        <tr>
                            <td class="tnr size14">du</td>
                            <td class="tnr size14 bold"><?php echo $dateDeliberation; ?> </td>
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
                            <td class="tnr size14"><?php echo $ne; ?> le <?php echo $dateNaissAct; ?>
                                à <?php echo $lieuNaiss; ?> (<?php echo $paysNaiss; ?>)
                            </td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table style="border-collapse: collapse ;" border="0">
                        <tr>
                            <td class="tnr size14"><?php echo $etud; ?> en&nbsp;</td>
                            <td class="tnr size14 bold"><?php echo $niveau; ?> <?php echo $formation; ?></td>
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
                            <td class="tnr size14 bold">est <?= $admis ?> en classe supérieure.</td>
                        </tr>
                    </table>
                    <div class="tnr size12"></div>
                    <div class="tnr size12"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">La présente attestation est délivrée pour servir et valoir ce que de
                                droit.
                            </td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <div class="tnr size14"></div>
                    <div class="tnr size14"></div>
                    <div class="tnr size14"></div>
                    <div class="tnr size13 center" style="padding-left: 77.5mm">Fait à Dakar,
                        le <?php echo $dateActuel; ?></div>
                    <div class="tnr size12"></div>
                    <div class="tnr size12"></div>
                    <div class="tnr size12"></div>
                    <div class="tnr size12 bold center" style="padding-left: 77.5mm">Le Chef des Services
                        Administratifs
                    </div>
                </page>
                <?php

            } else {   //générer attestation de réussite
                //$contentReussite = "";
                ?>
                <page>
                    <div class="entete">
                        <div class="arial center size9 bold">UNIVERSITE CHEIKH ANTA DIOP DE DAKAR</div>
                        <div class="divLogo"><img class="logo" src="../img/logo_ucad.png"></div>
                        <div class="arial center size11 bold">École Supérieure Polytechnique</div>
                        <div class="arial center size9 bold">SERVICE DE LA SCOLARITE</div>
                        <div class="arial center size8 bold">B.P. 5085 - DAKAR-FANN</div>
                        <div class="arial center size8 bold">Tel (221) 33 864 51 96 - Fax (221) 33 825 55 94</div>
                        <div class="arial center size8 bold">
                            <table style="margin: auto;">
                                <tr>
                                    <td>E-mail :</td>
                                    <td style="color: blue; text-decoration: underline">scolarite.esp@ucad.edu.sn</td>
                                </tr>
                            </table>
                        </div>
                        <div class="arial center size8"></div>
                        <div class="arial center size8"></div>
                        <div class="arial center size16"></div>
                    </div>
                    <div class="center">
                        <table style="margin: auto">
                            <tr>
                                <td class="arial size20 bold"
                                    style="background-color: rgb(223,223,233);border: double; border-style: double; border-color: #000000; border-width: 5px;">
                                    ATTESTATION DE REUSSITE
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="tnr size16"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">Après délibération du Jury de fin de Formation en date</td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">du</td>
                            <td class="tnr size14 bold"><?php echo $dateDeliberation; ?></td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table>
                        <tr>
                            <td class="tnr size14"><?php echo $situation; ?></td>
                            <td class="tnr size14 bold"><?php echo $prenom; ?> <?php echo $nom; ?></td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table>
                        <tr>
                            <td class="tnr size14"><?php echo $ne; ?> le <?php echo $dateNaissAct; ?>
                                à <?php echo $lieuNaiss; ?> (<?php echo $paysNaiss; ?>)
                            </td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">a effectué la scolarité réglementaire et satisfait aux conditions
                                prescrites pour
                            </td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">l'obtention du</td>
                            <td class="tnr size14 bold"><?php echo $formation; ?></td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">Spécialité :</td>
                            <td class="tnr size14 bold"><?php echo $option; ?></td>
                        </tr>
                    </table>
                    <div class="tnr size14"></div>
                    <table>
                        <tr>
                            <td class="tnr size14 bold">PROMOTION :<?php echo $promotion; ?></td>
                        </tr>
                    </table>
                    <div class="tnr size18"></div>
                    <table>
                        <tr>
                            <td class="tnr size14">La présente attestation est délivrée pour servir et valoir ce que de
                                droit.
                            </td>
                        </tr>
                    </table>
                    <div class="tnr size16"></div>
                    <div class="tnr size14"></div>
                    <div class="tnr size14"></div>
                    <div class="tnr size13 center" style="padding-left: 77.5mm">Fait à Dakar,
                        le <?php echo $dateActuel; ?></div>
                    <div class="tnr size12"></div>
                    <div class="tnr size12"></div>
                    <div class="tnr size12"></div>
                    <div class="tnr size12 bold center" style="padding-left: 77.5mm">Le Chef des Services
                        Administratifs
                    </div>
                    <div class="tnr size12 bold center" style="padding-left: 77.5mm; padding-top: 30mm">Amadou Tidiane
                        LY
                    </div>
                    <div class="tnr size8"></div>
                    <div class="tnr size8"></div>
                    <div class="tnr size10" style="font-style: italic">N.B : Il n'est pas délivré de duplicata de cette
                        attestation. Il appartient au titulaire d'établir lui-même et de faire
                        certifier conformes par les services compétents, les copies qui peuvent lui être nécessaires.
                    </div>

                </page>
                <?php
            }

        }//end if resultat=passe
    $content .= ob_get_clean();
	} //end foreach
	 $content = htmlspecialchars_decode(htmlentities($content, ENT_NOQUOTES, "UTF-8"));
    ob_end_clean();
    require_once('../classes/html2pdf/vendor/autoload.php');
    require_once("../classes/html2pdf/html2pdf.class.php");
    try {
        $pdf = new HTML2PDF('P','A4','fr',false,'ISO-8859-15',array(25,15,25,25));
        $pdf->addFont('algerian','normal', '../fonts/algerian.php');
        $pdf->addFont('ariaal','normal' , '../fonts/ariaal.php');
        $pdf->writeHTML($content);
        $pdf->Output('test1.pdf');
    } catch (HTML2PDF_exception $e) {
        die($e);
    }
?>
