<?php
require_once '../lib/includes.php';
require_once 'etudiant.php';
$user = null;
if(isset($_GET['id'])){
    $user = unEtudiant($db, $_GET['id']);
}

$stylesheets = "
<link rel='stylesheet' type='text/css' href='../css/resume1.min.css'/>
<link rel='stylesheet' type='text/css' href='../css/recherche.css'/>
<link rel='stylesheet' type='text/css' href='../css/index.css'/>";
$title = "Ajouter un Utilisateur";
require_once '../partials/admin_header.php';
?>

<div class="row">
    <div class="col-xs-12 col-lg-12">
        <div class="box">
            <div class="box box-header">
                <h4>Detail</h4>
            </div>
            <div class="box box-body">
                <fieldset>
                    <legend>Information de l'etudiant</legend>
                    <div class="col-xs-12">
                        <label class="col-xs-4">Carte Nationnal d'identite :</label>
                        <div class="col-xs-8">
                            <?= $user['cni'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Prenom :</label>
                        <div class="col-xs-8">
                            <?= $user['prenom'] ?>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <label class="col-xs-4">Nom :</label>
                        <div class="col-xs-8">
                            <?= $user['nom'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Sexe :</label>
                        <div class="col-xs-8">
                            <?= $user['sexe'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Date de Naissance :</label>
                        <div class="col-xs-8">
                            <?= $user['dateNaiss'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Pays de Naissance :</label>
                        <div class="col-xs-8">
                            <?= $user['paysNaiss'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Lieu de Naissance :</label>
                        <div class="col-xs-8">
                            <?= $user['lieuNaiss'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Numero de Telephone :</label>
                        <div class="col-xs-8">
                            <?= $user['numTel'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Serie du Bac :</label>
                        <div class="col-xs-8">
                            <?= $user['serieBac'] ?>
                        </div>
                    </div>

                </fieldset>

                <br>
                <br>

                <fieldset>
                    <legend>Année Académique</legend>
                    <div class="col-xs-12">
                        <label class="col-xs-4">Annee Academique :</label>
                        <div class="col-xs-8">
                            <?= $user['annee'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Departement :</label>
                        <div class="col-xs-8">
                            <?= $user['nomDept'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Option :</label>
                        <div class="col-xs-8">
                            <?= $user['nomOption'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Formation :</label>
                        <div class="col-xs-8">
                            <?= $user['formation'] ?>
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <label class="col-xs-4">Niveau :</label>
                        <div class="col-xs-8">
                            <?= $user['niveau'] ?>
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <label class="col-xs-4">Nature :</label>
                        <div class="col-xs-8">
                            <?= $user['nature'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Prise en charge :</label>
                        <div class="col-xs-8">
                            <?= $user['priseEnCharge'] ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <label class="col-xs-4">Resultat :</label>
                        <div class="col-xs-8">
                            <?= $user['resultat'] ?>
                        </div>
                    </div>

                </fieldset>
            </div>
            <div class="box box-footer">
                <button class="btn btn-default"><a href="modifierEtudiant.php?id=<?php echo $user['id'];?>">Modifier</a></button>
                <button class="btn btn-default"><a href="indexEtudiant.php?page=1">Retour</a></button>
            </div>
        </div>
    </div>
</div>
