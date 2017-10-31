  <?php
  $auth=0;
  require '../lib/includes.php';
  global $departement;
  if(isset($_POST['departement'])){
      $departement= $db->quote($_POST['departement']);
  }
  else{
      setFlash('Veuillez renseigner le departement','warning');
      header('location:importation.php');
      die();
  }
  if (isset($_FILES["fichierExcel"]) and $_FILES["fichierExcel"]["error"] == 0)
  {
      if ($_FILES["fichierExcel"]["size"] <= 100000000)
      {
          $infos_fich = pathinfo($_FILES["fichierExcel"]["name"]);
          $extension_fich = $infos_fich["extension"];
          $extensions_autorisees = array('xlsx','xls');
          if (in_array($extension_fich, $extensions_autorisees))
          {
              $nomf=$_FILES["fichierExcel"]["name"];
              $nomfAct=str_replace(' ','_',$nomf);
              move_uploaded_file($_FILES["fichierExcel"]["tmp_name"], '../Imports/'.$nomfAct);
              //$_SESSION["photoClient"][$j] = $photoClient = $ine.'.'.$extension_img;
              $fichier = $_FILES["fichierExcel"]["name"];

              //debut enregistrement donnees en bd

              mb_internal_encoding('UTF-8');
              function InsererIntoEtudiants($thearray=array(),$indices=array(),$db){
                  $cni = $db->quote($thearray[$indices[0]]);
                  $nationalite= $db->quote($thearray[$indices[1]]);
                  $prenom = $db->quote($thearray[$indices[2]]);
                  $nom = $db->quote($thearray[$indices[3]]);
                  $sexe = $db->quote($thearray[$indices[4]]=="Monsieur"?"Masculin":"Feminin");
                  $dateNaiss = $thearray[$indices[5]];//Changer le formatt en aaaa-mm-jj
                  if(!is_null($dateNaiss)){
                      $datearray = explode('-', $dateNaiss );
                      $dateNaiss = "19".$datearray[2]."-".$datearray[0]."-".$datearray[1];
                      $dateNaiss = $db->quote($dateNaiss);
                  }
                  $paysNaiss = $thearray[$indices[6]]; //extraire jusqu au premier (
                  
                    //verfier si le format est lieuNaiss/paysNaiss
                     //var_dump(strpos($paysNaiss,'/'));
                   if (strpos($paysNaiss,'/')) { //si oui 
                           $paysarray = explode('/',$paysNaiss );
                           $lieuNaiss=trim($paysarray[0]);
                           $lieuNaiss =$db->quote($lieuNaiss);
                           $paysNaiss=trim($paysarray[1]);     
                           $paysNaiss = $db->quote($paysNaiss);   
                   }  
                   else {   //si le format  est lieuNaiss(paysNaiss)
                        $paysarray = explode('(',$paysNaiss );
                        $paysNaiss = explode(')',$paysarray[1])[0];
                        $paysNaiss = trim($paysNaiss);
                        $paysNaiss = $db->quote($paysNaiss);
                        $lieuNaiss = trim($paysarray[0]);
                        $lieuNaiss = $db->quote($lieuNaiss); // ce qui ne se trouve pas entre les parantheeses
                   }
                  $numTel = $db->quote($thearray[$indices[7]]);
                  //verifier si l'etudiant n'existe pas déjà dans la table des étudiants 
                  $req=$db->query("SELECT COUNT(*) as NbNewse FROM etudiant WHERE cni=$cni"); 
                  $donne = $req->fetch();
                   $req->closeCursor();
                  if ($donne['NbNewse']==0){ //n'existe pas déjà  
                    $db->query("INSERT INTO etudiant VALUES ('',$cni,$nationalite,$prenom,$nom,$sexe,$dateNaiss,$paysNaiss,$lieuNaiss,$numTel, '')");
                    //return $db->lastInsertId(); 
                 }
                //recuperer l'id de l'étudiant
                $requete=$db->query("SELECT id FROM etudiant WHERE cni=$cni"); 
                  $donnee = $requete->fetch();
                  $req->closeCursor();
                  return $donnee['id'];
                }

              function InsererIntoInfosAnnuelles($thearray=array(),$anneeAcad,$indices=array(),$db,$idEtud,$departement){
                  $civilite = $db->quote($thearray[$indices[0]]);
                  $annee = $db->quote($anneeAcad); // a gerer
                  $nomDept = $departement;
                  $nomOption = $db->quote($thearray[$indices[1]]);// a gerer
                  $formation = $db->quote($thearray[$indices[2]]);
                  $niveau = $db->quote($thearray[$indices[3]]);
                  $nature = $db->quote($thearray[$indices[4]]);
                  /*c'etait en commentaire  */
                  //$priseEnCharge = $db->quote($thearray[$indices[5]]);
                  //verifier les valeurs mis dans la colonne déliberarion
                  $deliberation=$db->quote($thearray[$indices[5]]);
                  //recuperer les 4 prémiers caractères du valeur de colonne delibération et le mettre en majuscule
                  $delib=substr($deliberation,1,4);
                  $delibe =mb_strtoupper($delib,mb_internal_encoding());
                  //var_dump($delibe);
                 if(($delibe == 'ADMI')||($delibe == 'DIPL')) //admis ou réussi
                     $resultat = "'Passe'";
                 elseif($delibe == 'AUTO')   //redouble
                      $resultat = "'Redouble'";
                 elseif($delibe == 'EXLU')  //exclu(e)
                      $resultat = "'Exclu'";
                 elseif($delibe == 'ABAN')  
                      $resultat = "'Abandonne'";
                  elseif($delibe == 'SELE') //selectionné en DIC ou DESCAF
                      $resultat = "'Selectionne'";
                  else  $resultat = "''";      //y a rien dans la colonne delibération
                  //recupérer la date de délibération  (indice 12)
                  $dateDeliberation= $thearray[$indices[6]];
                 //Changer le formatt en aaaa-mm-jj 
                   if(!is_null($dateDeliberation)){
                      $datearray = explode('-', $dateDeliberation );
                      $dateDeliberation = "20".$datearray[2]."-".$datearray[0]."-".$datearray[1];
                      $dateDeliberation = $db->quote($dateDeliberation);
                  }
                  else $dateDeliberation="''";
                  //ajouter Matricule (indice 0)
                   $matricule=$db->quote($thearray[$indices[7]]);
            
                 // var_dump($nature);
                  //var_dump($resultat);
                  //$priseEnCharge='';   //à gerer aprés  
                  /*
                  //Net à payer  (23)
                   $netAPayer=$db->quote($thearray[$indices[7]]);
                  //Montant versé (24)
                    $montantVerse=$db->quote($thearray[$indices[8]]);
                  //Montant Restant (25)
                     $montantRestant=$db->quote($thearray[$indices[9]]);
                  //Boursier (27)
                      $boursier=$db->quote($thearray[$indices[10]]);
                      */
                  /* gérer le faite que etudiant existe déjà ou non dans cette année académique */
                  $req=$db->query("SELECT COUNT(*) as NbNews FROM infosannuelles WHERE idEtudiant=$idEtud AND annee=$annee" );
                  $donnees = $req->fetch();
                 $req->closeCursor();
                //var_dump($donnees['NbNews']);
                  if ($donnees['NbNews']==0) //n'existe pas déjà  
                  $db->query("INSERT INTO infosannuelles VALUES('',$idEtud,$civilite,$annee,$nomDept,$nomOption,$formation,$niveau,$nature,'',$resultat,$dateDeliberation,$matricule)");
                  else {   //existe déja dans cette année donc on va juste faire un mise à jour sur la colonne résultat,date Deliberation
                   $db->query("UPDATE infosannuelles SET resultat=$resultat ,dateDeliberation=$dateDeliberation WHERE idEtudiant=$idEtud");          
                  }   
              }

              function AjoutEtudNouvAnnee($db) {
                  $requete = $db->query("INSERT INTO infosAnnuelles(idEtudiant, civilite, annee, nomDept, nomOption, formation, niveau, nature, priseEnCharge, resultat)
                        SELECT idEtudiant, civilite, annee, nomDept, nomOption, formation, niveau, nature, priseEnCharge, resultat FROM infosAnnuelles1 ");
                  $requete->closeCursor();
                  $reqDelete = $db->query("TRUNCATE TABLE infosAnnuelles1");
                  $reqDelete->closeCursor();
              }
              
              //  Include PHPExcel_IOFactory
              include '../classes/PHPExcel/IOFactory.php';
              //$inputFileName = 'DGI-2016.xls';
              $inputFileName = '../Imports/'.$nomfAct;

              //  Read your Excel workbook
              try {
                  $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                  $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                  $objPHPExcel = $objReader->load($inputFileName);
              } catch(Exception $e) {
                  die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
              }

              //  Get worksheet dimensions
              $sheet = $objPHPExcel->getSheet(0);
              $highestRow = $sheet->getHighestRow();
              $highestColumn = $sheet->getHighestColumn();

              global $anneeAcad;
              //variable pour les indices du tableau

              //Recuperation de l'annee académique
              for ($row = 1; $row <= 2; $row++) {
                  //  Read a row of data into an array
                  $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, FALSE, TRUE);//NULL,TRUE,FALSE
                  //$tab[] = $rowData;
                  //  Insert row data array into database here using your own structure
                  if ($row == 1) {
                      continue;
                  }
                  $annee = $rowData[0][6];
                  
                  //if (strpos($annee,'-')) { //si la date d'inscription est sous format JJ-MM-AA
                  $annee = explode('-',$annee);
                   //var_dump($annee);
                   
                  $mois = intval($annee[0]);
                  $annee = $annee[2]; 
                  $annee = intval('20'.$annee);  
                  
                  //}
                   /*
                 if (strpos($annee,'/')) {      //la date d'inscription est sous format JJ/MM/AA
                   $annee = explode('/',$annee);
                  $mois = intval($annee[1]);
                  $annee = $annee[2];
                  $annee = intval('20'.$annee);
                  }
                  */

                  if($mois>=9){
                      $anneeAcad = strval($annee).'-'.strval($annee+1);

                  }
                  else{
                      $anneeAcad = strval($annee-1).'-'.strval($annee);
                  }

              }

                //  Loop through each row of the worksheet in turn

              for ($row = 1; $row <= $highestRow-2; $row++) {
                  //  Read a row of data into an array
                  $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, FALSE, TRUE);//NULL,TRUE,FALSE
                  //$tab[] = $rowData;
                  //  Insert row data array into database here using your own structure
                  if ($row == 1) {
                      continue;
                  }
                  $tab[] = $rowData[0];
                  $indices = [1,19, 2, 3, 17, 4, 5, 20];
                  //echo $anneeAcad;
                  //die();
                  $idEtud = InsererIntoEtudiants($rowData[0], $indices, $db);
                  $indices = [17, 15, 14, 13,21, 8,12,0];

                  InsererIntoInfosAnnuelles($rowData[0],$anneeAcad,$indices, $db, $idEtud,$departement);
              }
              AjoutEtudNouvAnnee($db);
              //echo "Fichier importe avec succes!";
              setFlash('Importation réussie');
              header('location:resume.php');
          }
          else
          {
              setFlash("Votre fichier n'est pas un fichier Excel !",'warning');
              header('location:importation.php');

          }
      }
      else
      {
          setFlash("Taille dépassée!",'warning');
          header('location:importation.php');

      }
  }
  else
  {
      setFlash("Erreur chargement de fichier! Veuillez rentrer un fichier valide",'danger');
      header('location:importation.php');
  }
              
  ?>