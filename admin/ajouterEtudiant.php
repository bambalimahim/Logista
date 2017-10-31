<?php
require_once '../lib/includes.php';
require_once 'etudiant.php';
if(isset($_POST) && count($_POST) != 0){
    $id = ajouterEtudiantTout($db, $_POST);
    if($id){
        setFlash('Ajout reussi');
        header('location: indexEtudiant.php?page=1');
        die();
    }
    else{
        setFlash('Veuillez bien remplir les informations de l\'etudiant','danger');
        header('location: ajouterEtudiant.php');
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
<!--    <div class="box ">-->
<!--        <div class="box-header">-->
<!--            <h2 class="box-title text-capitalize">Ajout d'un etudiant</h2>-->
<!--        </div>-->
<!---->
<!--        <div class="box box-body no-padding">-->
<!--            <form action="" method="post" class="form-horizontal">-->
<!--                <fieldset>-->
<!--                    <legend>Information de l'etudiant</legend>-->
<!--                    <div class="form-group">-->
<!--                        <label for="cni" class="control-label col-sm-2">Carte Nationnale d'identite :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="cni" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="prenom" class="control-label col-sm-2">Prenom :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="prenom" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="nom" class="control-label col-sm-2">Nom :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="nom" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="sexe" class="control-label col-sm-2">Sexe :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <select name="sexe" id="">-->
<!--                                <option value="Masculin">Homme</option>-->
<!--                                <option value="Feminin">Femme</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="dateNaiss" class="control-label col-sm-2">Date de Naissance :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="date" name="dateNaiss" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="paysNaiss" class="control-label col-sm-2">Pays de Naissance :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="paysNaiss" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="lieuNaiss" class="control-label col-sm-2">Lieu d Naissance :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="lieuNaiss" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="numTel" class="control-label col-sm-2">Numero de Telephone :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="numTel" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="serieBac" class="control-label col-sm-2">Serie du Bac :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="serieBac" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </fieldset>-->
<!---->
<!--                <fieldset>-->
<!--                    <legend>Année Académique</legend>-->
<!--                    <div class="form-group">-->
<!--                        <label for="annee" class="control-label col-sm-2">Annee academique :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="annee" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="nomDept" class="control-label col-sm-2">Nom du departement :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="nomDept" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="nomOption" class="control-label col-sm-2">Option :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="nomOption" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="formation" class="control-label col-sm-2">Formation :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="formation" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="niveau" class="control-label col-sm-2">Niveau :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" name="niveau" class="form-control">-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="nature" class="control-label col-sm-2">Nature :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <select name="nature" id="">-->
<!--                                <option value="Jour">Jour</option>-->
<!--                                <option value="Soir">Soir</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="priseEnCharge" class="control-label col-sm-2">Prise en charge :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <select name="priseEnCharge" id="">-->
<!--                                <option value="Etat">Etat</option>-->
<!--                                <option value="Tiers">Tiers</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label for="resultat" class="control-label col-sm-2">Resultat :</label>-->
<!--                        <div class="col-sm-6">-->
<!--                            <select name="resultat" id="">-->
<!--                                <option value="Passe">Passe</option>-->
<!--                                <option value="Redouble">Redouble</option>-->
<!--                                <option value="Exclu">Exclu</option>-->
<!--                                <option value="Abandonne">Abandonne</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!---->
<!--                </fieldset>-->
<!--        </div>-->
<!---->
<!--        <div class="box box-footer">-->
<!--            <div class="form-group">-->
<!--                <label for="" class="control-label col-sm-2"></label>-->
<!--                <div class="col-sm-6">-->
<!--                    <button type="submit" class="btn btn-primary">Ajouter un etudiant</button>-->
<!--                </div>-->
<!--            </div>-->
<!--            </form>-->
<!--        </div>-->
<!--     </div>-->
<!---->
<!--    </div>-->

    <div class="modal fade" id="ajouterEtudiant" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Ajouter Un Etudiant</h4>
                </div>
                <div class="modal-body">
                    <form action="indexEtudiant.php?page=1" method="post" class="form-horizontal">
                        <fieldset>
                            <legend>Information de l'etudiant</legend>
                            <div class="form-group">
                                <label for="id" class="control-label col-sm-2"></label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="id" id="etudiant_id" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cni" class="control-label col-sm-4">Carte Nationnale d'identite :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="cni" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="prenom" class="control-label col-sm-4">Prenom :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="prenom" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nom" class="control-label col-sm-4">Nom :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nom" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sexe" class="control-label col-sm-4">Sexe :</label>
                                <div class="col-sm-6">
                                    <select name="sexe" id="">
                                        <option value="Masculin">Homme</option>
                                        <option value="Feminin">Femme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dateNaiss" class="control-label col-sm-4">Date de Naissance :</label>
                                <div class="col-sm-6">
                                    <input type="date" name="dateNaiss" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="paysNaiss" class="control-label col-sm-4">Pays de Naissance :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="paysNaiss" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lieuNaiss" class="control-label col-sm-4">Lieu d Naissance :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lieuNaiss" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="numTel" class="control-label col-sm-4">Numero de Telephone :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="numTel" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="serieBac" class="control-label col-sm-4">Serie du Bac :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="serieBac" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset>
                            <legend>Année Académique</legend>
                            <div class="form-group">
                                <label for="annee" class="control-label col-sm-4">Annee academique :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="annee" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nomDept" class="control-label col-sm-4">Nom du departement :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nomDept" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nomOption" class="control-label col-sm-4">Option :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nomOption" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="formation" class="control-label col-sm-4">Formation :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="formation" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="niveau" class="control-label col-sm-4">Niveau :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="niveau" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nature" class="control-label col-sm-4">Nature :</label>
                                <div class="col-sm-6">
                                    <select name="nature" id="">
                                        <option value="Jour">Jour</option>
                                        <option value="Soir">Soir</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="priseEnCharge" class="control-label col-sm-4">Prise en charge :</label>
                                <div class="col-sm-6">
                                    <select name="priseEnCharge" id="">
                                        <option value="Etat">Etat</option>
                                        <option value="Tiers">Tiers</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="resultat" class="control-label col-sm-4">Resultat :</label>
                                <div class="col-sm-6">
                                    <select name="resultat" id="">
                                        <option value="Passe">Passe</option>
                                        <option value="Redouble">Redouble</option>
                                        <option value="Exclu">Exclu</option>
                                        <option value="Abandonne">Abandonne</option>
                                    </select>
                                </div>
                            </div>



                        </fieldset>
                </div>

                <div class="modal-footer ">
                    <div class="form-group">
                        <label for="" class="control-label col-sm-4"></label>
                        <div class="col-sm-6">
                            <button type="submit" id="submit" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Ajouter</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



<?php
$scripts = "
    <script>
        $(document).ready(function(){
            $('#ajouterEtudiant').modal(\"show\");
        })
    </script>
";
require_once '../partials/footer_admin.php';
?>