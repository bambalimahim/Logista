<?php
  require_once '../lib/includes.php';
  
   $resultats = getSearchResults();
   if(isset($_POST['resultats'])){ //sera vrai si au moins un checkbox a Ã©tÃ© cochÃ©
		$j=0;
		if(isset($_SESSION['attestResults'])){
			unset($_SESSION['attestResults']);
		}
		for($i=0; $i<count($_POST['resultats']);$j++){
			if(intval($_POST['resultats'][$i])==$j){
				$i++;
				$_SESSION['attestResults'][]=$resultats[$j];
			}
		}
    }
    if (isset($_POST["valid_typeAttestation"]))
    {
    $typeAttestation = $_POST["typeAttestation"];
    if ($typeAttestation=='CertificatInscription') {
        header('location:certificatInscription.php');
    }
	 //var_dump($_SESSION['attestResults']);
?>
<html>
	<head>
  <title>Type Attestation </title>

	</head>


<body class="hold-transition skin-blue sidebar-mini">  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	 <h3> 
        <?php
					
        ?>			  
		</h3>
    <section class="content-header">
      <h2>
        <b>Bienvenue ! </b>
        </h2>
        <h1>Veuillez choisir le type d'attestation à generer  </h1>
 <!-- Main content -->
  </section>
  <center>
 <form id="petit_form" action="TypeAttestation.php" method="POST">
          <div class="row">
                      <div class="col-md-offset-3 col-md-6">
                <select name="typeAttestation" id="typeAttestation" class="form-control" autofocus> 
          <option disabled selected>Type Attestation</option>
          <option value="CertificatInscription">CertificatInscription</option>
          <option value="AttestationResultat">AttestationResultat</option>
        </select> <br>    
             </div>  
                      </div>
					  <br>
            <br>    
				
				<button type="submit" id="valid_typeAttestation" name="valid_typeAttestation">valider</button>   
            <button type="button" id="annul_typeAttestation" name="annul_typeAttestation" >Annuler</button>	
			
        </form>  
        </center>
			 <?php
			          ?>
					        <center>
					        <form id="form_jury" action="attestation_resultat.php" method="POST">
							   <label> date de délibération du Jury : <label>
							   <input type="date" name="dateJury" id="dateJury" class="form-control" autofocus><br><br>
							<button type="submit" id="valid_dateJury" name="valid_dateJury">valider</button> 
                            </form>							
							 </center>
					  <?php 
					  /*
					  if (isset($_POST["valid_dateJury"])) {
					             if(isset($_SESSION['dateJury'])){
			                         unset($_SESSION['dateJury']);
		                         }
								 $_SESSION['dateJury'] = $_POST["dateJury"];
                                	 header('location:attestation_resultat.php');
  									 
					  }
                   */



	   }
        ?>
        
   </div>


</body>
</html>


        
    


		
