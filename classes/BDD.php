<?php 
	require_once 'InfosEtudiant.php';
	require_once 'Utilitaires.php';

	class BDD {
		public static function init($nomBD) {
			try {
				$bdd = new PDO("mysql:host=localhost;dbname=".$nomBD,"root","");
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			} catch (Exception $e) {
				//header("location");
				return null;
			}
			return $bdd;
		}

        public static function nommageChamp($champ) {
            switch ($champ) {
                case "annee" :
                    return "Annee academique";
                case "nomDept" :
                    return "Departement";
                case "nomOption" :
                    return "Option";
                case "priseEnCharge" :
                    return "Prise en charge";
                case "nature" :
                    return "Nature";
                case "formation" :
                    return "Formation";
                case "niveau" :
                    return "Niveau";
                case "sexe" :
                    return "Sexe";
                case "paysNaiss" :
                    return "Pays naissance";
                case "lieuNaiss" :
                    return "Lieu naissance";
                case "anneeNaiss" :
                    return "Annee naissance";
                case "numero" :
                    return "Prefixe numero";
                case "resultat" :
                    return "Resultat";
            }
        }

		public static function selectChamp($bdd, $champ, $valChampPrec="Berserker") {
            if ($valChampPrec=="Berserker") {
                $requete='SELECT DISTINCT '.$champ.' FROM etudiant e, infosAnnuelles i 
						  WHERE e.id=i.idEtudiant';
                if ($champ=="anneeNaiss") {
                    $requete='SELECT DISTINCT YEAR(dateNaiss) as anneeNaiss FROM etudiant e';
                }
                if ($champ=="numero") {
                    $requete='SELECT DISTINCT SUBSTRING(numTel FROM 1 FOR 2) as numero FROM etudiant e';
                }
            }
            else {
                switch ($champ) {
                    case "nomOption" :
                        $requete='SELECT DISTINCT nomOption FROM etudiant e, infosAnnuelles i 
								WHERE e.id=i.idEtudiant AND nomDept="'.$valChampPrec.'"';
                        break;
                    case "formation" :
                        $requete='SELECT DISTINCT formation FROM etudiant e, infosAnnuelles i 
								WHERE e.id=i.idEtudiant AND nomOption="'.$valChampPrec.'"';
                        break;
                    case "niveau" :
                        $requete='SELECT DISTINCT niveau FROM etudiant e, infosAnnuelles i 
								WHERE e.id=i.idEtudiant AND formation="'.$valChampPrec.'"';
                        break;
                    default :
                        $requete="SELECT DISTINCT ".$champ." FROM etudiant e, infosAnnuelles i 
						  WHERE e.id=i.idEtudiant";
                }
            }
			$req = $bdd->query($requete);
            $donnees = $req->fetchAll();
            $req->closeCursor();
			return $donnees;
		}

        public static function countStat($champs, $valChamps, $etudRes){
            $resultat=0;
            for ($i=0; $i<count($etudRes); $i++) {
                for($j=0; $j<count($champs); $j++) {
                    if ($champs[$j]=='anneeNaiss') {
                        if (strlen($etudRes[$i]['dateNaiss'])<4 or substr($etudRes[$i]['dateNaiss'],0,4)!=$valChamps[$j])
                            break;
                    }
                    elseif ($champs[$j]=='numero') {
                        if (strlen($etudRes[$i]['numTel'])<2 or substr($etudRes[$i]['numTel'],0,2)!=$valChamps[$j]) {
                            break;
                        }
                    }
                    else
                        if ($etudRes[$i][$champs[$j]]!=$valChamps[$j])
                            break;
                }

                if ($j==count($champs))
                    $resultat ++;
            }
            return $resultat;
        }


        public static function requeteStatEtudiant($bdd, $formStat, $etudRes, $niveau, $valChamps) {
            if ($niveau-1>=0 AND in_array($formStat[$niveau-1], ['nomDept', 'nomOption','formation']) AND in_array($formStat[$niveau], ['nomOption','formation','niveau']))
                $donnees = self::selectChamp($bdd, $formStat[$niveau],$valChamps[$niveau-1]);
            else
                $donnees = self::selectChamp($bdd, $formStat[$niveau]);
            if ($niveau==count($formStat)-1) {
                for ($j = 0; $j < count($donnees); $j++) {
                    $valChamps[$niveau] = $donnees[$j][$formStat[$niveau]];
                    $resArray[$valChamps[$niveau]] = self::countStat($formStat, $valChamps, $etudRes);
                }
            }
            else  {
                for ($j=0; $j<count($donnees); $j++) {
                    $valChamps[$niveau] = $donnees[$j][$formStat[$niveau]];
                    $resArray[$valChamps[$niveau]] = self::requeteStatEtudiant($bdd, $formStat, $etudRes, $niveau+1, $valChamps);
                }
            }
            return $resArray;
        }

        public static function extraireValArray($resArray, $champs, $niveau) {
            if (is_array($resArray)) {
                return self::extraireValArray($resArray[$champs[$niveau]], $champs, $niveau+1);
            }
            else {
                return $resArray;
            }

        }

        public static function tableauStat($resArrayDyn,$resArray,$formStat,$niveau, $champs, $totalRes) {
            $tableau = "";
                $tableau .= "<table class='table-hover' border='1' style='border-collapse: collapse; width: 100%; height: 100%; border-top: hidden; border-color: #00a7d0' cellspacing='0' cellpadding='0'>";
            if ($niveau==count($formStat)-1) {
                for ($i=0; $i<count($resArrayDyn); $i++) {
                    //var_dump(array_keys($resArray)[$i]);
                    if ($i==0)
                        $borderTop =  "border-top: hidden";
                    else
                        $borderTop="";
                    $champs[$niveau]=array_keys($resArrayDyn)[$i];
                    $valeur = self::extraireValArray($resArray, $champs, 0);
                    $tableau .= "<tr style='border-collapse: collapse'>";
                    $tableau .= "<td style='width: 180px; text-align: center;". $borderTop."'>".$champs[$niveau]."</td>";
                    $tableau .= "<td style='width: 40px; text-align: center; font-weight: bold ; color: white; background-color: #00a7d0;'>".$valeur."</td>";
                    $tableau .= "</tr>";
                }
            }
            else {
                for ($i=0; $i<count($resArrayDyn); $i++) {
                    if ($i==0 AND $niveau!=0)
                        $borderTop =  "border-top: hidden";
                    else
                        $borderTop="";
                    $champs[$niveau]=array_keys($resArrayDyn)[$i];
                    $tableau .= "<tr>";
                    $tableau .= "<td style='width: 180px; text-align: center;".$borderTop."'>".$champs[$niveau]."</td>";
                    $tableau .= "<td>".self::tableauStat($resArrayDyn[$champs[$niveau]], $resArray, $formStat, $niveau+1, $champs,$totalRes)."</td>";
                    $tableau .= "</tr>";

                }
            }

                $tableau .= "</table>";
            return $tableau;
        }

        public static function recupererValStat($resArrayDyn,$resArray,$formStat,$niveau,$champs,&$elt, &$tableau) {
            if ($niveau==count($formStat)-1) {
                for ($i=0; $i<count($resArrayDyn); $i++) {
                    $champs[$niveau]=array_keys($resArrayDyn)[$i];
                    $tableau[$elt][0] = $champs;
                    $tableau[$elt][1]= self::extraireValArray($resArray, $champs, 0);
                    $elt++;
                    //var_dump($champs);
                }

            }
            else {
                for ($i=0; $i<count($resArrayDyn); $i++) {
                    $champs[$niveau]=array_keys($resArrayDyn)[$i];
                    self::recupererValStat($resArrayDyn[$champs[$niveau]], $resArray, $formStat, $niveau+1,$champs, $elt,$tableau);
                }

            }
        }

        public static function getPredefinedMessages($bdd) {
            $req = $bdd->query("SELECT object, content from predefinedMessages");
            return $req;
        }

		
		public static function requeteEtudiant($bdd, $etud, $filtres, &$lieux) {
            $rech = $etud->convertirPourRech($filtres);

            $requet = 'SELECT  idEtudiant,nom, prenom, cni, matricule, sexe, civilite, dateNaiss, paysNaiss, nationalite, lieuNaiss, numTel, serieBac,
								civilite, annee, i.nomDept, i.nomOption,formation, niveau, nature, priseEnCharge, resultat
								FROM etudiant e, infosAnnuelles i
								WHERE e.id=i.idEtudiant
								';
			$requete = ' 	AND UPPER(nom) LIKE '.strtoupper($rech->etudiant->nom).' AND UPPER(prenom) LIKE '.strtoupper($rech->etudiant->prenom).' 
						AND cni LIKE '.$rech->etudiant->cni.' AND UPPER(matricule) LIKE '.$rech->matricule.' AND numTel LIKE '.$rech->etudiant->numTel.'  

						AND UPPER(serieBac) LIKE '.strtoupper($rech->etudiant->serieBac);
			if ($rech->etudiant->sexe!='')
				$requete .= ' AND sexe IN '.$rech->etudiant->sexe;
			if ($rech->etudiant->dateNaiss[0]!='')
				$requete .= ' AND DAY(dateNaiss)'.$rech->etudiant->dateNaiss[0];
			if ($rech->etudiant->dateNaiss[1]!='')
				$requete .= ' AND MONTH(dateNaiss)'.$rech->etudiant->dateNaiss[1];
			if ($rech->etudiant->dateNaiss[2]!='')
				$requete .= ' AND YEAR(dateNaiss)'.$rech->etudiant->dateNaiss[2];
			if ($rech->etudiant->paysNaiss!='') 
				$requete .= ' AND paysNaiss IN '.$rech->etudiant->paysNaiss;
			if ($rech->etudiant->lieuNaiss!='')
				$requete .= ' AND lieuNaiss IN '.$rech->etudiant->lieuNaiss;
            if ($rech->etudiant->nationalite!='')
                $requete .= ' AND lieuNaiss IN '.$rech->etudiant->nationalite;
            if ($rech->civilite!='')
                $requete .= ' AND annee IN '.$rech->civilite;
            if ($rech->annee!='')
				$requete .= ' AND annee IN '.$rech->annee;
			if ($rech->formation!='')
				$requete .= ' AND formation IN '.$rech->formation;
			if ($rech->niveau!='')
				$requete .= ' AND niveau IN '.$rech->niveau;
			if ($rech->nature!='')
				$requete .= ' AND nature IN '.$rech->nature;
			if ($rech->priseEnCharge!='')
				$requete .= ' AND priseEnCharge IN '.$rech->priseEnCharge;
			if ($rech->nomDept!='')
				$requete .= ' AND nomDept IN '.$rech->nomDept;
			if ($rech->nomOption!='')
				$requete .= ' AND nomOption IN '.$rech->nomOption;

			$requeteGroupBy = ' GROUP BY idEtudiant
								ORDER BY nom';
            $requet.=$requete.$requeteGroupBy;
			$req = $bdd->query($requet);

            $requeteLieux = 'SELECT paysNaiss, lieuNaiss, count(*) as nbLieu
								FROM etudiant e, infosAnnuelles i
								WHERE e.id=i.idEtudiant'.$requete.' GROUP BY paysNaiss, lieuNaiss';
            $reqLieux = $bdd->query($requeteLieux);
            $lieux = $reqLieux->fetchAll();
			return $req;
		}

        public static function location($db, $pays, $lieu, &$latitude, &$longitude) {
            $req = $db->prepare('SELECT latitude, longitude FROM location WHERE pays=:pays AND lieu=:lieu');
            $req->bindValue(':pays', $pays);
            $req->bindValue('lieu', $lieu);
            $req->execute();
            if ($donnee=$req->fetch(PDO::FETCH_ASSOC)) {
                $latitude = floatval($donnee['latitude']);
                $longitude = floatval($donnee['longitude']);
            }
            else {
                $latitude = 0.0;
                $longitude = 0.0;
            }
        }

        public static function insertLocation($db, $pays, $lieu, $lat, $long) {
            $req = $db->prepare('INSERT INTO location(pays, lieu, latitude, longitude) VALUES(:pays,:lieu,:lat,:long)');
            $req->bindValue(':pays', $pays);
            $req->bindValue(':lieu', $lieu);
            $req->bindValue(':lat', $lat);
            $req->bindValue(':long', $long);
            $req->execute();
        }

	}

?>