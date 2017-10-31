<?php
require_once '../lib/includes.php';
require_once 'etudiant.php';
$user = null;
if(isset($_GET['id'])){
    $user = unEtudiant($db, $_GET['id']);
}


if(isset($_POST) && !is_null($_POST) && isset($_POST['id'])){//    var_dump($_POST);
    $id = modifierEtudiant($db,$_POST);
    if($id){
        setFlash("Modification reussie");
        header('location:indexEtudiant.php?page=1');
        die();
    }
    else{
        setFlash("Echec de la modification : Veuillez bien remplir les champs !");
        header('location:indexEtudiant.php?page=1');
        die();
    }

}




$stylesheets = "
<link rel='stylesheet' type='text/css' href='../css/resume1.min.css'/>
<link rel='stylesheet' type='text/css' href='../css/recherche.css'/>
<link rel='stylesheet' type='text/css' href='../css/index.css'/>";
$title = "Ajouter un Utilisateur";
require_once '../partials/admin_header.php';
?>

<div class="row panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<form action="" method="post" class="form-horizontal">
    <div class="panel panel-default"><!--Filtres -->
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                Ajouter un etudiant
            </h4>
        </div>

        <div class="panel panel-body">
            <fieldset>
                <legend>Information de l'etudiant</legend>
                <div class="form-group">
                    <label for="id" class="control-label col-sm-2"></label>
                    <div class="col-sm-6">
                        <input type="hidden" name="id" class="form-control" value="<?php echo isset($user['id'])? $user['id'] : null ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cni" class="control-label col-sm-2">Carte Nationnale d'identite :</label>
                    <div class="col-sm-6">
                        <input type="text" name="cni" class="form-control" value="<?php echo isset($user['cni'])? $user['cni'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="prenom" class="control-label col-sm-2">Prenom :</label>
                    <div class="col-sm-6">
                        <input type="text" name="prenom" class="form-control" value="<?php echo isset($user['prenom'])? $user['prenom'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nom" class="control-label col-sm-2">Nom :</label>
                    <div class="col-sm-6">
                        <input type="text" name="nom" class="form-control" value="<?php echo isset($user['nom'])? $user['nom'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sexe" class="control-label col-sm-2">Sexe :</label>
                    <div class="col-sm-6">
                        <select name="sexe" id="">
                            <option value="Masculin" <?php echo $user['sexe'] == "Masculin" ? "selected" : null ; ?>>Homme</option>
                            <option value="Feminin" <?php echo $user['sexe'] == "Feminin" ? "selected" : null ; ?>>Femme</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dateNaiss" class="control-label col-sm-2">Date de Naissance :</label>
                    <div class="col-sm-6">
                        <input type="date" name="dateNaiss" class="form-control" value="<?php echo isset($user['dateNaiss'])? $user['dateNaiss'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="paysNaiss" class="control-label col-sm-2">Pays de Naissance :</label>
                    <div class="col-sm-6">
                        <input type="text" name="paysNaiss" class="form-control" value="<?php echo isset($user['paysNaiss'])? $user['paysNaiss'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="lieuNaiss" class="control-label col-sm-2">Lieu d Naissance :</label>
                    <div class="col-sm-6">
                        <input type="text" name="lieuNaiss" class="form-control" value="<?php echo isset($user['lieuNaiss'])? $user['lieuNaiss'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="numTel" class="control-label col-sm-2">Numero de Telephone :</label>
                    <div class="col-sm-6">
                        <input type="text" name="numTel" class="form-control" value="<?php echo isset($user['numTel'])? $user['numTel'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="serieBac" class="control-label col-sm-2">Serie du Bac :</label>
                    <div class="col-sm-6">
                        <input type="text" name="serieBac" class="form-control" value="<?php echo isset($user['serieBac'])? $user['serieBac'] : null ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Année Académique</legend>
                <div class="form-group">
                    <label for="idEtudiant" class="control-label col-sm-2"></label>
                    <div class="col-sm-6">
                        <input type="hidden" name="idEtudiant" class="form-control" value="<?php echo isset($user['idEtudiant'])? $user['idEtudiant']: null ; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="annee" class="control-label col-sm-2">Annee academique :</label>
                    <div class="col-sm-6">
                        <input type="text" name="annee" class="form-control" value="<?php echo isset($user['annee'])? $user['annee'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomDept" class="control-label col-sm-2">Nom du departement :</label>
                    <div class="col-sm-6">
                        <input type="text" name="nomDept" class="form-control" value="<?php echo isset($user['nomDept'])? $user['nomDept'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomOption" class="control-label col-sm-2">Option :</label>
                    <div class="col-sm-6">
                        <input type="text" name="nomOption" class="form-control" value="<?php echo isset($user['nomOption'])? $user['nomOption'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="formation" class="control-label col-sm-2">Formation :</label>
                    <div class="col-sm-6">
                        <input type="text" name="formation" class="form-control" value="<?php echo isset($user['formation'])? $user['formation'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="niveau" class="control-label col-sm-2">Niveau :</label>
                    <div class="col-sm-6">
                        <input type="text" name="niveau" class="form-control" value="<?php echo isset($user['niveau'])? $user['niveau'] : null ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="nature" class="control-label col-sm-2">Nature :</label>
                    <div class="col-sm-6">
                        <select name="nature" id="">
                            <option value="Jour" <?php echo $user['nature'] == "Jour" ? "selected" : null; ?>>Jour</option>
                            <option value="Soir" <?php echo $user['nature'] == "Soir" ? "selected" : null; ?>>Soir</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="priseEnCharge" class="control-label col-sm-2">Prise en charge :</label>
                    <div class="col-sm-6">
                        <select name="priseEnCharge" id="">
                            <option value="Etat"<?php echo $user['priseEnCharge'] == "Etat" ? "selected" : null; ?>>Etat</option>
                            <option value="Tiers"<?php echo $user['priseEnCharge'] == "Tiers" ? "selected" : null; ?>>Tiers</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="resultat" class="control-label col-sm-2">Resultat :</label>
                    <div class="col-sm-6">
                        <select name="resultat" id="">
                            <option value="Passe" <?php echo $user['resultat'] =="Passe"? "selected": null ; ?>>Passe</option>
                            <option value="Redouble" <?php echo $user['resultat'] =="Redouble"? "selected": null ; ?>>Redouble</option>
                            <option value="Exclu" <?php echo $user['resultat']=="Exclu" ? "selected": null ;?>>Exclu</option>
                            <option value="Abandonne" <?php echo $user['resultat'] =="Abandonne" ? "selected": null ;?> >Abandonne</option>
                        </select>
                    </div>
                </div>



            </fieldset>
        </div>


        <div class="form-group">
            <label for="" class="control-label col-sm-2"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">Modifier un etudiant</button>
                <button type="submit" class="btn btn-danger "><a href="indexEtudiant.php?page=1">Annuler</a></button>

            </div>
        </div>

</form>
</div>

<?php
$scripts = "";
require_once '../partials/footer_admin.php';
?>
