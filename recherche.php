<?php
$stylesheets = "
    <!-- Theme style -->
    <link rel=\"stylesheet\" href=\"css/AdminLTE.min.css\">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel=\"stylesheet\" href=\"css/skins/_all-skins.min.css\">
  
";
$stylesheets .= "<link rel='stylesheet' type='text/css' href='css/recherche.css'/>
<link rel='stylesheet' href='css/bootstrap-select.min.css'>
";
$title = "Recherche";
include('lib/includes.php');
function getOptions($nomDept,$db){
	$nomDept = $db->quote($nomDept);
	$sel = $db->query("SELECT DISTINCT nomOption from infosAnnuelles WHERE nomDept=$nomDept ORDER BY nomOption");
	return $sel->fetchAll();
}
function getnbOptions($nomDept,$db){
	return count(getOptions($nomDept,$db));
}
$sel = $db->query("SELECT DISTINCT paysNaiss from etudiant ORDER BY paysNaiss");
$paysNaiss = $sel->fetchAll();
$sel = $db->query("SELECT DISTINCT lieuNaiss from etudiant ORDER BY lieuNaiss");
$lieuNaisss = $sel->fetchAll();
$sel = $db->query("SELECT DISTINCT nomDept as departement from infosAnnuelles ORDER BY nomDept");
$departements = $sel->fetchAll();
$sel = $db->query("SELECT DISTINCT formation from infosAnnuelles ORDER BY formation");
$formations = $sel->fetchAll();
$sel = $db->query("SELECT DISTINCT niveau from infosAnnuelles ORDER BY niveau");
$niveaux = $sel->fetchAll();
$sel = $db->query("SELECT DISTINCT annee from infosAnnuelles ORDER BY annee");
$annees = $sel->fetchAll();
$sel = $db->query("SELECT DISTINCT nationalite from etudiant ORDER BY nationalite");
$nationalites = $sel->fetchAll();
$sel = $db->query("SELECT DISTINCT civilite from infosAnnuelles ORDER BY civilite");
$civilites = $sel->fetchAll();
if(isset($_SESSION['Auth']['user'])){
	if($_SESSION['Auth']['user']['statut']=='Admin'){
		require_once 'partials/admin_header_gen.php';
	}
	else{
		require_once 'partials/header.php';
	}
}
?>
<div class="row panel-group col-xs-12" id="accordion" role="tablist" aria-multiselectable="true" style="margin: auto;margin-top: -100px">
	<form action="rechercheTraitement.php" method="POST">
		<div class="panel panel-default"><!--Filtres -->
			<div class="panel-heading" role="tab" id="headingOne" style="">
				<h4 class="panel-title">
					<a role="button" id="z" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<i class="more-less glyphicon glyphicon-chevron-down"></i>
						Paramètres de Recherche
					</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					<div class="form-group col-xs-2 col-xs-offset-10">
						<br>
						<label for="filteradder">
							Ajouter un champ
						</label>
						<select id="filteradder" class="form-control">
							<option value="dfault" selected="selected">Nom Champ</option>
							<option value="cni">CNI</option>
							<option value="matricule">Matricule</option>
							<option value="numTel">Numéro de Téléphone</option>
							<option value="serieBac">Série Bac</option>
						</select>
					</div>
					<div class="form-group col-xs-6">
						<label for="prenom">Prénom</label>
						<div class="input-group">
							<input type="hidden" name="search_param_prenom" value="" id="search_param_prenom">
							<input type="text" class="form-control" name="prenom" id="prenom">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept_prenom">Contient</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#contient">Contient</a></li>
									<li><a href="#commencepar">Commence par</a></li>
									<li><a href="#terminepar">Termine par</a></li>
									<li><a href="#est">Est</a></li>
								</ul>
							</div>
						</div>
					</div><!--Fin form-groupok-->
					<div class="form-group col-xs-6">
						<label for="nom">Nom</label>
						<div class="input-group">
							<input type="hidden" name="search_param_nom" value="" id="search_param_nom">
							<input type="text" class="form-control" name="nom" id="nom">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept_nom">Contient</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#contient">Contient</a></li>
									<li><a href="#commencepar">Commence par</a></li>
									<li><a href="#terminepar">Termine par</a></li>
									<li><a href="#est">Est</a></li>
								</ul>
							</div>
						</div>
					</div><!--Fin form-groupok-->
					<!--<div class="form-group col-xs-6">
						<label for="cni">CNI</label>
						<div class="input-group">
							<input type="hidden" name="search_param_cni" value="" id="search_param_cni">
							<input type="text" class="form-control" name="cni" id="cni">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept_cni">Contient</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#contient">Contient</a></li>
									<li><a href="#commencepar">Commence par</a></li>
									<li><a href="#terminepar">Termine par</a></li>
									<li><a href="#est">Est</a></li>
								</ul>
							</div>
						</div>
					</div>--><!--Fin form-groupok-->
					<!--<div class="form-group col-xs-6">
						<label for="matricule">Matricule</label>
						<div class="input-group">
							<input type="hidden" name="search_param_matricule" value="" id="search_param_matricule">
							<input type="text" class="form-control" name="matricule" id="matricule">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept_matricule">Contient</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#contient">Contient</a></li>
									<li><a href="#commencepar">Commence par</a></li>
									<li><a href="#terminepar">Termine par</a></li>
									<li><a href="#est">Est</a></li>
								</ul>
							</div>
						</div>
					</div>--><!--Fin form-groupok-->
					<div class="form-group col-xs-6">
						<label for="civilite">Civilité</label>
						<select class="form-control selectpicker" id="civilite" name="civilite[]" multiple>
							<?php foreach ($civilites as $civilite):?>
								<option value="<?= $civilite['civilite'] ?>" ><?= $civilite['civilite'] ?></option>
							<?php endforeach; ?>
						</select>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-6">
						<label for="nationalite">Nationalité</label>
						<select class="form-control selectpicker" name="nationalite[]" id="nationalite" multiple>
							<?php foreach ($nationalites as $nationalite):?>
								<option value="<?= $nationalite['nationalite'] ?>" ><?= $nationalite['nationalite'] ?></option>
							<?php endforeach; ?>
						</select>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-3">
						<label for="paysNaiss">Pays de Naissance</label>
						<select class="form-control selectpicker" name="paysNaiss[]" id="paysNaiss" multiple>
							<?php foreach ($paysNaiss as $pays):?>
								<option value="<?= $pays['paysNaiss'] ?>" ><?= $pays['paysNaiss'] ?></option>
							<?php endforeach; ?>
						</select>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-3">
						<label for="lieuNaiss">Lieu de Naissance</label>
						<select class="form-control selectpicker" id="lieuNaiss" name="lieuNaiss[]" multiple>
							<?php foreach ($lieuNaisss as $lieuNaiss):?>
								<option value="<?= $lieuNaiss['lieuNaiss'] ?>" ><?= $lieuNaiss['lieuNaiss'] ?></option>
							<?php endforeach; ?>
						</select>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-2">
						<label for="jourNaiss">Jour de Naissance</label>
						<div class="input-group">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept_jourNaiss">=</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#supoeg"> >= </a></li>
									<li><a href="#eg"> = </a></li>
									<li><a href="#infoeg"> <= </a></li>
								</ul>
							</div>
							<input type="hidden" name="search_param_jourNaiss" value="" id="search_param_jourNaiss">
							<input type="number" class="form-control" name="jourNaiss" id="jourNaiss" max="31" min="1">
						</div>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-2">
						<label for="moisNaiss">Mois de Naissance</label>
						<div class="input-group">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept_moisNaiss"> = </span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#supoeg"> >= </a></li>
									<li><a href="#eg"> = </a></li>
									<li><a href="#infoeg"> <= </a></li>
								</ul>
							</div>
							<input type="hidden" name="search_param_moisNaiss" value="" id="search_param_moisNaiss">
							<input type="number" class="form-control" name="moisNaiss" id="moisNaiss" max="12" min="1">
						</div>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-2">
						<label for="anneeNaiss">Année de Naissance</label>
						<div class="input-group">
							<div class="input-group-btn search-panel">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span id="search_concept_anneeNaiss">=</span> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#supoeg"> >= </a></li>
									<li><a href="#eg"> = </a></li>
									<li><a href="#infoeg"> <= </a></li>
								</ul>
							</div>
							<input type="hidden" name="search_param_anneeNaiss" value="" id="search_param_anneeNaiss">
							<input type="number" class="form-control" name="anneeNaiss" id="anneeNaiss" min="1">
						</div>
					</div><!--Fin form-group-->
					<fieldset class="col-xs-12">
						<legend>Département/Formation</legend>
						<div class="form-group col-xs-6">
							<?php foreach ($departements as $departement):?>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="nomDept[]" id="$departement['departement'] ?>" value="<?= $departement['departement'] ?>">
									<?= $departement['departement'] ?>
								</label>
							</div>
								<?php
								$nbr = getnbOptions($departement['departement'],$db);
								for($i=1;$i<=$nbr+2;$i++){
									echo '<br>';
								}
								?>
							<?php endforeach; ?>
						</div>
						<!-- Options-->
						<div class="form-group col-xs-6">
							<?php foreach ($departements as $departement){?>
								<?php foreach (getOptions($departement['departement'],$db) as $option){ ?>
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="nomOption[]" id="<?= $option['nomOption'] ?>" value="<?= $option['nomOption'] ?>">
										<?= $option['nomOption'] ?>
									</label>
								</div>
								<?php } ?>
								<br>
							<?php } ?>
						</div>
						<div class="col-xs-12">
							<div class="form-group col-xs-6">
								<label for="formation">Formation</label>
								<select class="form-control selectpicker" multiple name="formation[]" id="formation">
									<?php foreach ($formations as $formation):?>
										<option value="<?= $formation['formation'] ?>"><?= $formation['formation'] ?></option>
									<?php endforeach; ?>
								</select>
							</div><!--Fin form-group-->
							<div class="form-group col-xs-6">
								<label for="niveau">Niveau</label>
								<select class="form-control selectpicker" multiple name="niveau[]" id="niveau">
									<?php foreach ($niveaux as $niveau):?>
										<option value="<?= $niveau['niveau'] ?>"><?= $niveau['niveau'] ?></option>
									<?php endforeach; ?>
								</select>
							</div><!--Fin form-group-->

						</div>
					</fieldset>
					<div class="form-group col-xs-6">
						<br>
						<label>Sexe</label>
						<div class="input-group">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="sexe[]" id="sexeMasc" value="Masculin">
									Masculin
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="sexe[]" id="sexeFem" value="Feminin">
									Féminin
								</label>
							</div>
						</div>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-6">
						<br>
						<label>Résultats</label>
						<div class="input-group">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="resultat[]" id="ResPasse" value="Passe">
									Passe
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="resultat[]" id="ResRedouble" value="Redouble">
									Redouble
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="resultat[]" id="ResAbandonne" value="Abandonne">
									Abandonne
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="resultat[]" id="ResExclu" value="Exclu">
									Exclu
								</label>
							</div>
						</div>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-6">
						<br>
						<label>Nature</label>
						<div class="input-group">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="nature[]" id="jour" value="jour">
									Jour
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="nature[]" id="soir" value="soir">
									Soir
								</label>
							</div>
						</div>
					</div><!--Fin form-group-->
					<div class="form-group col-xs-6">
						<br>
						<label>Prise En Charge</label>
						<div class="input-group">
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="priseEnCharge[]" id="etat" value="etat">
									Etat
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="priseEnCharge[]" id="tiers" value="tiers">
									Tiers
								</label>
							</div>
						</div>
					</div><!--Fin form-group-->
					<fieldset class="col-xs-12 aneees">
						<legend>Année Académique</legend>
						<div class="form-group col-xs-12">
							<label for="formation">Année Académique</label>
							<select class="form-control selectpicker" multiple name="annee[]" id="formation">
								<?php foreach ($annees as $annee):?>
									<option><?= $annee['annee'] ?></option>
								<?php endforeach; ?>
							</select>
						</div><!--Fin form-group-->
					</fieldset>
				</div>
			</div>
		</div><!--Fin Filtres -->
		<div class="form-group col-xs-12 text-center" style="margin-top: 25px">
			<input class="btn btn-primary btn-lg" type="submit" value="Rechercher" style="border-radius:0">
			<input class="btn btn-default btn-lg" type="reset" value="Réinitialiser" style="border-radius:0">
		</div>
		<!--<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<i class="more-less glyphicon glyphicon-chevron-down"></i>
						Statistiques
					</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				<div class="panel-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
				</div>
			</div>
		</div>--><!--Fin Filtres -->
	</form>

</div><!-- panel-group -->
<?php
	$scripts = "
			<script type='text/javascript' src='js/recherche.js'></script>
			<script type='text/javascript' src='js/bootstrap-select.min.js'></script>
	";
	require_once 'partials/footer.php';
?>
