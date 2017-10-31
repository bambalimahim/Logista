<?php

require_once '../lib/includes.php';
require_once 'utilisateur.php';
$utilisateurs = allUtilisateur($db);

if( !empty($_POST) && $_POST['id'] == ""){
    $id = ajouterUtilisateur($db, $_POST);
    if($id == false){
        setFlash('Echec de l\'ajout de l\'utilisateur', 'success');
        header('location:indexUtilisateur.php');
        die();
    }
    else{
        setFlash( 'Ajout reussi', 'success');
        header('location:indexUtilisateur.php?');
        die();
    }
}


if(!empty($_POST) && $_POST['id'] != ""  ){
    $id = modifierUtilisateur($db, $_POST);
    if($id == true) {
        setFlash('Modification reussie');
        header('location:indexUtilisateur.php');
        die();

    }
    else{
        setFlash('Echec de la modification', 'danger');
        header('location:ajouterUtilisateur.php');
        die();
    }


}

if(isset($_GET['id'])){
    $id = supprimerUtilisateur($db, $_GET['id']);
    if($id){
        setFlash('Suppression reussi', 'success');
        header('location:indexUtilisateur.php');
    }
    else{
        setFlash('Echec de la Suppression','danger');
        header('location:indexUtilisateur.php');
    }


}

$stylesheets = "
<link rel='stylesheet' type='text/css' href='../css/resume1.min.css'/>
<link rel='stylesheet' type='text/css' href='../css/recherche.css'/>
<link rel='stylesheet' type='text/css' href='../css/index.css'/>";

$title = "Utilisateurs";
require_once '../partials/admin_header_v2.php';
?>
<section class="content-header">
    <h1>
        Logesta
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tableau de Bord </a></li>
        <li class="active">Gestion des Utilisateurs</li>
    </ol>
</section>
<section class="content">
    <div class="box ">
        <div class="box-header">
            <h2 class="box-title text-capitalize">Liste des utilisateurs</h2>
            <i class="more-less glyphicon glyphicon-chevron-down"></i>
        </div>

        <div class="box-body table-responsive no-padding">
            <table class="table  table-bordered table-responsive table-hover">
                <tr>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>E-mail</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <?php foreach($utilisateurs as $utilisateur):?>
                    <tr>
                        <td><?php echo $utilisateur['prenom']?></td>
                        <td><?php echo $utilisateur['nom']?></td>
                        <td><?php echo $utilisateur['email']?></td>
                        <td><?php echo $utilisateur['statut'] == "Admin" ? "Administrateur" : "Simple Utilisateur"; ?></td>
                        <td>
                            <button class="btn btn-success" onclick="modifier(<?= $utilisateur['id']; ?>)" ><span class="glyphicon glyphicon-pencil"></span>&nbsp Modifier</button>
                            <button class="btn btn-danger" onclick="supprimer(<?= $utilisateur['id']; ?>)" ><span class="glyphicon glyphicon-remove"></span>&nbsp Supprimer</button>
                            <button class="btn btn-default" onclick="voir(<?= $utilisateur['id']; ?>)" ><span class="glyphicon glyphicon-eye-open"></span>&nbsp Voir</button>

                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <span data-placement="top" data-toggle="tooltip" title="ajouterUtilisateur"><button class="btn btn-primary" data-title="Edit" data-toggle="modal" data-target="#ajouterUtilisateur" id="btnAdd">Ajouter un utilisateur</button></span>
        </div>


        <div class="modal fade" id="ajouterUtilisateur" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Ajouter Un Utilisateur</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="control-label col-sm-2"></label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="id" class="form-control">
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
                                <label for="email" class="control-label col-sm-4">E-mail :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label col-sm-4">Mot de passe :</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirmation_password" class="control-label col-sm-4">Confirmez votre mot de passe :</label>
                                <div class="col-sm-6">
                                    <input type="password" name="confirmation_password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="statut" class="control-label col-sm-4">Statut :</label>
                                <div class="col-sm-6">
                                    <select name="statut" id="" class="form-control">
                                        <option value="Admin">Administrateur</option>
                                        <option value="Simple utilisateur">Simple utilisateur</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer ">
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" id="submit" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Ajouter un utilisateur</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </div><!-- /.box -->



        <div class="modal fade supprimer" id="supprimerUtilisateur" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Supprimer Un Utilisateur</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="get">
                            <div class="form-group">
                                <label for="id" class="control-label col-sm-6"><strong>Etes-vous sur ?</strong></label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="id" id="user_id" class="form-control" >
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success " ><span class="glyphicon glyphicon-ok-sign"></span> Oui</button>
                        <button  onclick="return false" data-dismiss="modal" class="btn btn-danger non" ><span class="glyphicon glyphicon-ok-sign"></span> Non</button>

                        </form>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="voirUtilisateur" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Detail Utilisateur</h4>
                    </div>
                    <div class="modal-body" >
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="control-label col-lg-6"></label>
                                    <div class="col-lg-8" id="id_user">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="prenom" class="control-label col-lg-6">Prenom :</label>
                                    <div class="col-lg-8" id="prenom">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nom" class="control-label col-lg-6">Nom :</label>
                                    <div class="col-lg-8" id="nom">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label col-lg-6">E-mail :</label>
                                    <div class="col-lg-8" id="email">

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="statut" class="control-label col-lg-6">Statut :</label>
                                    <div class="col-lg-8" id="statut">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="button" class="btn btn-warning " data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span> Retour</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!--></div><!--><!--row content-->
</section>

    <script>
        
        function modifier(id){
            $('input[name=id]').val(id);
            $('input[name=password]').hide();
            $('label[for=password]').hide();
            $('label[for=confirmation_password]').hide();
            $('input[name=confirmation_password]').hide();
            $.post('./unUtilisateur.php', { id: id}, function(data, status){
                var user =JSON.parse(data);
                $('input[name=prenom]').val(user.prenom);
                $('input[name=nom]').val(user.nom);
                $('input[name=email]').val(user.email);
                $('input[name=statut]').val(user.statut);

                $('#submit').html('<span class="glyphicon glyphicon-ok-sign"></span> Modifier Un Utilisateur');
            });

            $('#ajouterUtilisateur').modal("show");
        }
        function supprimer(id){
            $('#user_id').val(id);
            $('#supprimerUtilisateur').modal("show");
        }
        function voir(id){
            $.post('./unUtilisateur.php',{ id: id}, function (data, status) {
                var user = JSON.parse(data);
                $('#prenom').text(user.prenom);
                $('#nom').text(user.nom);
                $('#email').text(user.email);
                $('#statut').text(user.statut);


            });
            $('#voirUtilisateur').modal("show");
        }
    </script>

<?php
$scripts = "
<script>
$('#btnAdd').click(function () {
    $('input[name=prenom').val('');
    $('input[name=nom]').val('');
    $('input[name=email]').val('');
    $('input[name=password]').val('');
    $('input[name=confirmation_password]').val('');
    $('input[name=statut]').val('');
    $('#submit').html('<span class=\"glyphicon glyphicon-ok-sign\"></span> Ajouter un utilisateur');
 });
</script>
";

require_once '../partials/footer_admin.php';
?>