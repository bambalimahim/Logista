<?php
require_once '../lib/includes.php';
require_once 'messsagesPredifinisdb.php';

$predefinedMessages = getAllpredefinedMessages($db);

// Ajout nouveau message predifini
if( !empty($_POST) && $_POST['id'] == ""){
    $response = addPredefinedMessage($db, $_POST['object'], $_POST['content']);
    if($response == false){
        setFlash('Echec de l\'ajout de l\'utilisateur', 'warning');
        header('location:messagesPredefinis.php');
    }
    else{
        setFlash( 'Ajout reussi', 'success');
        header('location:messagesPredefinis.php');
        die();
    }
}

//Update predefined message
if(!empty($_POST) && isset($_POST['id'])){
    $response = updatePredefinedMessage($db, $_POST['id'],$_POST['object'],$_POST['content']);
    if($response == true) {
        setFlash('Modification reussie');
        header('location:messagesPredefinis.php');
        die();

    }
    else{
        setFlash('Echec de la modification', 'danger');
        header('location:messagesPredefinis.php');
        die();
    }


}

//suppression mpredef
if(isset($_GET['id'])){
    $response = deletePredefinedMessage($db, $_GET['id']);
    if($response){
        setFlash('Suppression reussie', 'success');
        header('location:messagesPredefinis.php');
    }
    else{
        setFlash('Echec de la Suppression','danger');
        header('location:messagesPredefinis.php');
    }


}

$stylesheets = "
<link rel='stylesheet' type='text/css' href='../css/resume1.min.css'/>
<link rel='stylesheet' type='text/css' href='../css/recherche.css'/>
<link rel='stylesheet' type='text/css' href='../css/index.css'/>";
$title = "Messages Predefinis";
require_once '../partials/admin_header_v2.php';

?>
<section class="content-header">
    <?= flash() ?>
    <h1>
        Logesta
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tableau de Bord </a></li>
        <li class="active">Configuration Sms</li>
    </ol>
</section>

<section class="content">
    <div class="box ">
        <div class="box-header">
            <h2 class="box-title text-capitalize">Messages Prédéfinis</h2>

        </div>

        <div class="box-body table-responsive no-padding">
            <table class="table  table-bordered table-responsive table-hover">
                <tr>
                    <th>Objet</th>
                    <th>Contenu Sms</th>
                </tr>
                <?php foreach($predefinedMessages as $predefinedMessage) :?>
                    <tr>
                        <td><?= $predefinedMessage['object'] ?></td>
                        <td><?= $predefinedMessage['content'] ?></td>
                        <td>
                            <button class="btn btn-success" onclick="modifier(<?= $predefinedMessage['id']; ?>)" ><span class="glyphicon glyphicon-pencil"></span>&nbsp Modifier</button>
                            <button class="btn btn-danger" onclick="supprimer(<?= $predefinedMessage['id']; ?>)" ><span class="glyphicon glyphicon-remove"></span>&nbsp Supprimer</button>
                            <button class="btn btn-default" onclick="voir(<?= $predefinedMessage['id']; ?>)" ><span class="glyphicon glyphicon-eye-open"></span>&nbsp Voir</button>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <span data-placement="top" data-toggle="tooltip" title="ajouterUtilisateur"><button class="btn btn-primary" data-title="Edit" data-toggle="modal" data-target="#ajouterMessagePredefini" id="btnAdd">Nouveau Message prédéfini</button></span>
        </div>

        <!-- Modal ajout et modif -->
        <div class="modal fade" id="ajouterMessagePredefini" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Nouveau Message Prédéfini</h4>
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
                                <label for="object" class="control-label col-sm-4">Objet :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="object" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="control-label col-sm-4">Contenu sms :</label>
                                <div class="col-sm-6">
                                    <input type="text" name="content" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer ">
                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" id="submit" class="btn btn-primary btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Enregistrer</button>
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

        <!-- Modal suppression -->
        <div class="modal fade supprimer" id="supprimerUtilisateur" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Supprimer Message Predefin</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="get">
                            <div class="form-group">
                                <label for="id" class="control-label col-sm-6"><strong>Etes-vous sur ?</strong></label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="id" id="mpredef_id" class="form-control" >
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

        <!-- Modal voir -->
        <div class="modal fade" id="voirmpredef" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Details Message</h4>
                    </div>
                    <div class="modal-body" >
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="prenom" class="control-label col-lg-6">Objet :</label>
                                    <div class="col-lg-8" id="msgObject">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nom" class="control-label col-lg-6">Contenu :</label>
                                    <div class="col-lg-8" id="msgContent">

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

<?php
$scripts = "
<script>
    $('#btnAdd').click(function () {
            $('input[name=id]').val('');
            $('input[name=object]').val('');
            $('input[name=content]').val('');
            $('#submit').html('<span class=\"glyphicon glyphicon-ok-sign\"></span> Enregistrer');
    });
    function modifier(id){
        $('#ajouterMessagePredefini').modal(\"show\");
        $('input[name=id]').val(id);
        $.post('./getMessagePredefini.php', { id: id}, function(data, status){
            console.log(data);
            var predefinedMessage =JSON.parse(data);
            $('input[name=object]').val(predefinedMessage.object);
            $('input[name=content]').val(predefinedMessage.content);
            $('#submit').html('<span class=\"glyphicon glyphicon-ok-sign\"></span> Modifier Message');
        });

    }


    function supprimer(id){
        $('#mpredef_id').val(id);
        $('#supprimerUtilisateur').modal(\"show\");
    }
    
    function voir(id){
        $.post('./getMessagePredefini.php', { id: id}, function(data, status){
            console.log(data);
            var predefinedMessage =JSON.parse(data);
            $('#msgObject').text(predefinedMessage.object);
            $('#msgContent').text(predefinedMessage.content);
        });
        $('#voirmpredef').modal(\"show\");
    }
</script>
";
require_once '../partials/footer_admin.php';
?>