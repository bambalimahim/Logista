<?php
require_once '../lib/includes.php';
require_once 'utilisateur.php';
if(!is_null($_POST) && count($_POST) != 0 ){
    $id = ajouterUtilisateur($db, $_POST);
    if($id == false){
        setFlash('Echec de l\'ajout de l\'utilisateur', 'success');
        header('location:ajouterUtilisateur.php');
        die();
    }
    else{
        setFlash( 'Ajout reussi', 'success');
        header('location:indexUtilisateur.php?');
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

<!--<div class="row panel-group" id="accordion" role="tablist" aria-multiselectable="true">-->
<!--<form action="" method="post" class="form-horizontal">-->
<!--    <div class="form-group">-->
<!--        <label for="email" class="control-label col-sm-2">E-mail :</label>-->
<!--        <div class="col-sm-6">-->
<!--            <input type="text" name="email" class="form-control">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-group">-->
<!--        <label for="password" class="control-label col-sm-2">Mot de passe :</label>-->
<!--        <div class="col-sm-6">-->
<!--            <input type="password" name="password" class="form-control">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-group">-->
<!--        <label for="confirmation_password" class="control-label col-sm-2">Confirmez votre mot de passe :</label>-->
<!--        <div class="col-sm-6">-->
<!--            <input type="password" name="confirmation_password" class="form-control">-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="form-group">-->
<!--        <label for="" class="control-label col-sm-2"></label>-->
<!--        <div class="col-sm-6">-->
<!--            <select name="statut" id="" class="form-control">-->
<!--                <option value="Admin">Administrateur</option>-->
<!--                <option value="Simple utilisateur">Simple utilisateur</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!---->
<!---->
<!--    <div class="form-group">-->
<!--        <label for="" class="control-label col-sm-2"></label>-->
<!--        <div class="col-sm-6">-->
<!--            <button type="submit" class="btn btn-primary">Ajouter un utilisateur</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->
<!---->
<!--</div>-->

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
                        </div>
                        <div class="modal-footer ">
                            <div class="form-group">
                                <label for="" class="control-label col-sm-4"></label>
                                <div class="col-sm-6">
                                    <button type="submit" id="submit" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Ajouter un utilisateur</button>
                                </div>
                            </div>
                            </form>
                        </div>



                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

<?php
$scripts = "
    <script>
        $(document).ready(function(){
            $('#ajouterUtilisateur').modal(\"show\");
        })
    </script>
";
require_once '../partials/footer_admin.php';
?>