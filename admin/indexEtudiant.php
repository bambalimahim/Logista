<?php
require_once '../lib/includes.php';
require_once 'etudiant.php';
$etudiants = $db->query("SELECT e.id,e.cni,e.prenom,e.nom,e.sexe,DATE_FORMAT(e.dateNaiss,'%d-%m-%Y') AS dateNaiss, e.paysNaiss,e.lieuNaiss,
            i.nomDept as departement,i.formation,i.niveau,i.nature,i.nomOption
            FROM
            etudiant e, infosAnnuelles i
            WHERE e.id=i.idEtudiant
            ");
$etudiants = $etudiants->fetchAll();

//$etudiants = tousEtudiant($db);

$stylesheets = "
<!-- DataTables -->
<link rel='stylesheet' href='../plugins/datatables/dataTables.bootstrap.css'>
";

//ajouter un etudiant
if(!empty($_POST)  && $_POST['id'] == ""){
    $id = ajouterEtudiantTout($db, $_POST);
    if($id){
        setFlash('Ajout reussi');
        header('location: indexEtudiant.php?page=1');
        die();
    }
    else{
        setFlash('Veuillez bien remplir les informations de l\'etudiant','danger');
        header('location: indexEtudiant.php?page=1');
        die();
    }

}

//modifier un etudiant
if(!empty($_POST) && $_POST['id'] != ""){
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
$title = "Etudiants";
require_once '../partials/admin_header_v2.php';
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Logesta
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Tableau de Bord </a></li>
            <li class="active">Gestion des Etudiants</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Gestion des Etudiants</h3>
            </div>
            <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>CNI</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Sexe</th>
                        <th>Date de Naissance</th>
                        <th>Formation</th>
                        <th>Niveau</th>
                        <th>Jour/Soir</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($etudiants as $etudiant):?>
                        <tr>
                            <td><?= $etudiant['id'] ?></td>
                            <td><?= $etudiant['cni'] ?></td>
                            <td><?= $etudiant['prenom'] ?></td>
                            <td><?= $etudiant['nom'] ?></td>
                            <td><?= $etudiant['sexe'] ?></td>
                            <td><?= $etudiant['dateNaiss'] ?></td>
                            <td><?= $etudiant['formation'] ?></td>
                            <td><?= $etudiant['niveau'] ?></td>
                            <td><?= $etudiant['nature'] ?></td>
                            <td>
                                <button class="btn btn-primary"  onclick="modifier(<?= $etudiant['id']; ?>)"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Modifier</button>
                                <button class="btn btn-success"  onclick="voir(<?= $etudiant['id']; ?>)"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; Voir</button>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="text-left">
                    <br>
                    <span data-placement="top" data-toggle="tooltip" title="Edit" ><button class="btn btn-primary " data-title="Edit" data-toggle="modal" data-target="#ajouterEtudiant" ><span class="glyphicon glyphicon-plus"></span> Ajouter Un Etudiant</button></span>
                </div>
            </div>
        </div><!-- /.box -->
        <div class="modal fade " id="ajouterEtudiant" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Ajouter Un Etudiant</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form-horizontal">
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
                                    <label for="matricule" class="control-label col-sm-4">Matricule de l'Etudiant :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="matricule" class="form-control">
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
                                    <label for="nationalite" class="control-label col-sm-4">Nationalite :</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nationalite" class="form-control">
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
                                            <option value="Resultat">Resultat</option>
                                            <option value="Selectionne">Selectionne</option>
                                            <option value="Passe">Passe</option>
                                            <option value="Redouble">Redouble</option>
                                            <option value="Exclu">Exclu</option>
                                            <option value="Abandonne">Abandonne</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="dateDeliberation" class="control-label col-sm-4">Date de Deliberation :</label>
                                    <div class="col-sm-6">
                                        <input type="date" name="dateDeliberation" class="form-control">
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




        <div class="modal fade" id="voirEtudiant" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Detail Etudiant</h4>
                    </div>
                    <div class="modal-body">
                        <fieldset>
                            <legend>Information de l'etudiant</legend>
                            <div class="col-xs-12">
                                <label class="col-xs-4">Carte Nationnal d'identite :</label>
                                <div class="col-xs-8" id="cni">

                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Matricule de l'etudiant :</label>
                                <div class="col-xs-8" id="matricule">

                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Prenom :</label>
                                <div class="col-xs-8" id="prenom">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <label class="col-xs-4">Nom :</label>
                                <div class="col-xs-8" id="nom">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Sexe :</label>
                                <div class="col-xs-8" id="sexe">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Date de Naissance :</label>
                                <div class="col-xs-8" id="dateNaiss">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Pays de Naissance :</label>
                                <div class="col-xs-8" id="paysNaiss">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Lieu de Naissance :</label>
                                <div class="col-xs-8" id="lieuNaiss">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Numero de Telephone :</label>
                                <div class="col-xs-8" id="numTel">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Serie du Bac :</label>
                                <div class="col-xs-8" id="serieBac">
                                </div>
                            </div>

                        </fieldset>

                        <br>
                        <br>

                        <fieldset>
                            <legend>Année Académique</legend>
                            <div class="col-xs-12">
                                <label class="col-xs-4">Annee Academique :</label>
                                <div class="col-xs-8" id="annee">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Departement :</label>
                                <div class="col-xs-8" id="nomDept">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Option :</label>
                                <div class="col-xs-8" id="nomOption">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Formation :</label>
                                <div class="col-xs-8" id="formation">
                                </div>
                            </div>


                            <div class="col-xs-12">
                                <label class="col-xs-4">Niveau :</label>
                                <div class="col-xs-8" id="niveau">
                                </div>
                            </div>


                            <div class="col-xs-12">
                                <label class="col-xs-4">Nature :</label>
                                <div class="col-xs-8" id="nature">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Prise en charge :</label>
                                <div class="col-xs-8" id="priseEnCharge">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <label class="col-xs-4">Resultat :</label>
                                <div class="col-xs-8" id="resultat">
                                </div>
                            </div>
                            
                            <div class="col-xs-12">
                                <label class="col-xs-4">Date de Deliberation :</label>
                                <div class="col-xs-8" id="dateDeliberation">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" ><span class="glyphicon glyphicon-arrow-left "></span> Retour</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
<script type='text/javascript'>
    function modifier(id){
        $('#etudiant_id').val(id);
        $.post('./unEtudiant.php',{ id: id}, function(data,status){
            var etudiant = JSON.parse(data);
            $('input[name=cni]').val(etudiant.cni);
            $('input[name=matricule]').val(etudiant.matricule);
            $('input[name=nationalite]').val(etudiant.nationalite);
            $('input[name=prenom]').val(etudiant.prenom);
            $('input[name=nom]').val(etudiant.nom);
            $('input[name=sexe]').val(etudiant.sexe);
            $('input[name=dateNaiss]').val(etudiant.dateNaiss);
            $('input[name=paysNaiss]').val(etudiant.paysNaiss);
            $('input[name=lieuNaiss]').val(etudiant.lieuNaiss);
            $('input[name=numTel]').val(etudiant.numTel);
            $('input[name=serieBac]').val(etudiant.serieBac);
//            $('input[name=civilite]').val(etudiant.civilite);
            $('input[name=annee]').val(etudiant.annee);
            $('input[name=nomDept]').val(etudiant.nomDept);
            $('input[name=nomOption]').val(etudiant.nomOption);
            $('input[name=formation]').val(etudiant.formation);
            $('input[name=niveau]').val(etudiant.niveau);
            $('input[name=nature]').val(etudiant.nature);
            $('input[name=priseEnCharge]').val(etudiant.priseEnCharge);
            $('input[name=resultat]').val(etudiant.resultat);

            $('input[name=dateDeliberation]').val(etudiant.dateDeliberation);
            $('input[name=matricule]').val(etudiant.matricule);

            $('#submit').html('<span class="glyphicon glyphicon-ok-sign"></span> Modifier');

        });

        $('#ajouterEtudiant').modal('show');

    }


    function voir(id){
        console.log(id);
        $('#id_etudiant').val(id);
        $.post('./unEtudiant.php',{id: id},function(data, status){
            var etudiant = JSON.parse(data);
            $("#cni").text(etudiant.cni);
            $("#prenom").text(etudiant.prenom);
            $("#nom").text(etudiant.nom);
            $("#sexe").text(etudiant.sexe);
            $("#dateNaiss").text(etudiant.dateNaiss);
            $("#paysNaiss").text(etudiant.paysNaiss);
            $("#lieuNaiss").text(etudiant.lieuNaiss);
            $("#numTel").text(etudiant.numTel);
            $("#serieBac").text(etudiant.serieBac);
            $("#annee").text(etudiant.annee);
            $("#nomDept").text(etudiant.nomDept);
            $("#nomOption").text(etudiant.nomOption);
            $("#formation").text(etudiant.formation);
            $("#niveau").text(etudiant.niveau);
            $("#nature").text(etudiant.nature);
            $("#priseEnCharge").text(etudiant.priseEnCharge);
            $("#resultat").text(etudiant.resultat);
            $("#matricule").text(etudiant.matricule);
            $("#dateDeliberation").text(etudiant.dateDeliberation);

        });
        $('#voirEtudiant').modal("show");
    }

    function afficheE(){
        $('#ajouterEtudiant').modal("show");
    }


</script>

<?php
$scripts = "
<script type='text/javascript' src='../js/jquery.dynatable.js'></script>
<script type='text/javascript' src='../js/resume.js'></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': true,
          'ordering': true,
          'info' : true,
          'autoWidth' : false
        });
        $('.modal').on('hidden.bs.modal', function(e){ 
            $(this).removeData();
        }) ;
    });
</script>
";
require_once '../partials/footer_admin_v2.php';
?>
