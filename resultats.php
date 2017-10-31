<?php
require_once 'lib/includes.php';
require_once 'classes/BDD.php';
//get the predefinedmessages from the db
$predefinedMessages = BDD::getPredefinedMessages($db);
$resultats = getSearchResults();

$stylesheets = "
<!-- DataTables -->
<link rel='stylesheet' href='plugins/datatables/dataTables.bootstrap.css'>
";
$stylesheets .= "
    <!-- Theme style -->
    <link rel=\"stylesheet\" href=\"css/AdminLTE.min.css\">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel=\"stylesheet\" href=\"css/skins/_all-skins.min.css\">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel=\"stylesheet\" href=\"plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css\">
";
$stylesheets .= "
<link rel='stylesheet' type='text/css' href='css/recherche.css'/>
<style>
#loading {
    position: absolute;
    background:url('img/default.gif') no-repeat center center;
    width: 100%;
    height: 100%;
    display: none;
}
</style>
"
;
$title = "Résultats de la Recherche l";
if($_SESSION['Auth']['user']['statut']=='Admin'){
    require_once 'partials/admin_header_gen.php';
}else{
    require_once 'partials/header.php';
}
?>

<div id="loading"></div>

<div class="row col-xs-12" style="margin-top: -140px">

    <div class="col-lg-2 col-xs-4 text-center">
        <button class="btn btn-primary" type="submit" id="modalStat" data-toggle="modal" data-target="#statistiques"><span class="glyphicon glyphicon-stats"></span> Afficher Statistiques</button>
    </div>
    <div class="col-lg-2 col-xs-4 text-center">
        <a href="resultatExcel.php" target="_blank"><button class="btn btn-info" type="submit" id="modalResultatsExcel"><i class="fa fa-file-excel-o"></i> Exporter en Excel</button></a>
    </div>
    <?php /*if($_SESSION['Auth']['user']['statut']=='Admin') :*/?>
        <div class="col-lg-2 col-xs-4 text-center">
            <button class="btn btn-danger" type="submit" id="modalRapports" data-toggle="modal" data-target="#rapports"><i class="fa fa-file-pdf-o"></i> Generer rapports</button>
        </div>
        <div class="col-lg-2 col-xs-4 text-center">
            <button class="btn btn-warning" type="submit" id="modalContacts" data-toggle="modal" data-target="#contacts"><i class="fa fa-address-card"></i> Contacter etudiant</button>
        </div>
    <div class="col-lg-2 col-xs-4 text-center">
        <a href="geolocalisationTraitement.php" target="_blank" class="btn btn-success " ><i class="fa fa-map-marker"></i> Géolocalisation</a>
    </div>
    <?php /*endif;*/ ?>
    <div class="form-group col-lg-2 col-xs-4 pull-right">
        <select name="nom_col" id="nom_col" class="form-control" autofocus>
            <option selected value="1">Afficher plus</option>
            <option value="civilite">Civilité</option>
            <option value="nationalite">Nationalité</option>
            <option value="lieuNaiss">Lieu de Naissance</option>
            <option value="paysNaiss">Pays de Naissance</option>
            <option value="dateNaiss">Date de Naissance</option>
            <option value="sexe">Sexe</option>
            <option value="serieBac">Serie Bac</option>
            <option value="resultat">Résultat</option>
        </select>
        <!--            <a id="ajout_col" href="#" class="btn btn-info"><span class="glyphicon glyphicon-ok-sign"></span>Valider</a>-->
    </div><!--Fin form-groupok-->
    <div class="col-xs-12 text-right pull-right" style="margin-bottom:10px">
        <span><?php echo count(getSearchResults()).' Résultats Trouvés'  ?></span>
    </div>

    <div class="modal fade" id="statistiques" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formStat" name="affich_stat" id="affiche_stat"  action="statistiqueTraitement.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Critères statistiques</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-xs-12">
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="departement" name="stats[]" value ="nomDept"/>
                                    Par Département
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="option" name="stats[]" value ="nomOption"/>
                                    Par Option
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="annee" name="stats[]" value ="annee"/>
                                    Par Année Académique
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="priseEnCharge" name="stats[]" value ="priseEnCharge"/>
                                    Par Prise En Charge
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="nature" name="stats[]" value ="nature"/>
                                    Par Nature Jour/Soir
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="formation" name="stats[]" value ="formation"/>
                                    Par Formation
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="niveau" name="stats[]" value ="niveau"/>
                                    Par Niveau
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="sexe" name="stats[]" value ="sexe"/>
                                    Par Sexe
                                </label>
                            </div>
                            <!--<div class="form-check col-xs-3">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="serieBac" name="stats[]" value ="serieBac"/>
                                    Par Série Bac
                                </label>
                            </div>-->
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="paysNaiss" name="stats[]" value ="paysNaiss"/>
                                    Par Pays de Naissance
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="LieuNaiss" name="stats[]" value ="lieuNaiss"/>
                                    Par Lieu de Naissance
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="anneeNaiss" name="stats[]" value ="anneeNaiss"/>
                                    Par Année de Naissance
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="numero" name="stats[]" value ="numero"/>
                                    Par Préfixe Numéro
                                </label>
                            </div>
                            <div class="form-check col-xs-6">
                                <label class="form-check-label">
                                    <input type = "checkbox" id="resultat" name="stats[]" value ="resultat"/>
                                    Par Résultat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-info btn-lg" style="width: 100%;">Statistiques</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="example-modal">
        <div class="modal modal-primary" id="msgSent">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Information de la page</h4>
                    </div>
                    <div class="modal-body">
                        <p>Messages envoyés</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Fermer</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div><!-- /.example-modal -->

    

    <div class="modal fade" id="contacts" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="row well">
                <div class="col-xs-5">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h2 class="box-title"><b>Messages Prédifinis</b></h2>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked" id="predefinedMessages">
                                <?php
                                foreach ($predefinedMessages as $predefinedMessage) :
                                ?>
                                <li><a href="#"><?= $predefinedMessage['object'].' : '.$predefinedMessage['content']  ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
                <div class="col-xs-7">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Envoi de Sms</h3>
                        </div><!-- /.box-header -->
                        <form id="formContacts">
                        <div class="box-body">
                            <div class="form-group">
                                <input name="msgObject" id="msgObject" class="form-control" placeholder="Objet:" required="required">
                            </div>
                            <div class="form-group">
                                <textarea name="msgContent" id="msgContent" class="form-control" style="height: 300px">Contenu du message...</textarea>
                            </div>
                            <!--<div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment">
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>-->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary" id="btnSend"><i class="fa fa-envelope-o"></i> Envoyer</button>
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Annuler</button>
                        </div><!-- /.box-footer -->
                            <input id="choixEtud1" class="hidden" type="text" name="choixEtud1">
                        </form>
                    </div><!-- /. box -->
                </div><!-- /.col -->
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>

    <?php //if($_SESSION['Auth']['user']['statut']=='Admin') { ?>
    <div class="modal fade" id="rapports" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form target="_blank" action="admin/certificatInscription.php" method="POST" id="formRapports" class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Generation de rapports pour les étudiants sélectionnés</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col-md-offset-3 col-md-6" id="divChoixRap">
                                <label>Type d'attestation</label>
                                <select name="typeAttestation" id="typeAttestation" class="form-control" autofocus>
                                    <option value="CertificatInscription">Certificat Inscription</option>
                                    <option value="AttestationResultat">Attestation de Resultat</option>
                                </select> <br>
                            </div>
                            
                            <input id="choixEtud" class="hidden" type="text" name="choixEtud">
                        </div>
                        <br>
                        <br>
                    </div>
                     
                    <div class="modal-footer ">
                        <button id="buttRapport" type="submit" style="width: 100%;" class="btn btn-danger btn-lg text-center">Generer rapport</button>
                    </div>
                   
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
     <?php //} ?>

</div>

<div class="row col-xs-12" style="margin: auto; margin-top: -50px">

    <div class="row panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default"><!--Resultast recherche -->
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" id="z" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-chevron-down"></i>
                        <h4><span class="glyphicon glyphicon-education"></span> Résultats de la Recherche </h4>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="box-body table-responsive no-padding">
                        <form id="formAll" action="admin/TypeAttestation.php" method="POST">
                            <table id="my-table" name="monTableau" class="table table-hover table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr id="head">
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Matricule</th>
                                        <th>Departement</th>
                                        <th>Option</th>
                                        <th>Formation</th>
                                        <th>Niveau</th>
                                        <th>Numéro Téléphone</th>

                                        <th class="civilite">Civilité
                                        <th class="nationalite">Nationalité</th>
                                        <th class="lieuNaiss">Lieu de Naissance</th>
                                        <th class="paysNaiss">Pays de Naissance</th>
                                        <th class="dateNaiss">Date de Naissance</th>
                                        <th class="sexe">Sexe</th>
                                        <th class="serieBac">Serie Bac</th>
                                        <th class="resultat">Résultat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                 $i=0;								
								foreach($resultats as $etudiant):?>
                                    <tr>
                                        <td><input type="checkbox" name="resultats[]" value="<?= $i++; ?>"></td>
                                        <td class="notHidden"><?= $etudiant['prenom'] ?></td>
                                        <td class="notHidden"><?= $etudiant['nom'] ?></td>
                                        <td class="notHidden"><?= $etudiant['matricule'] ?></td>
                                        <td class="notHidden"><?= $etudiant['nomDept'] ?></td>
                                        <td class="notHidden"><?= $etudiant['nomOption'] ?></td>
                                        <td class="notHidden"><?= $etudiant['formation'] ?></td>
                                        <td class="notHidden"><?= $etudiant['niveau'] ?></td>

                                        <td class="notHidden"><?= $etudiant['numTel'] ?></td>

                                        <td class="civilite"><?= $etudiant['civilite'] ?></td>
                                        <td class="nationalite"><?= $etudiant['nationalite'] ?></td>
                                        <td class="lieuNaiss"><?= $etudiant['lieuNaiss'] ?></td>
                                        <td class="paysNaiss"><?= $etudiant['paysNaiss'] ?></td>
                                        <td class="dateNaiss"><?=  date("d-m-Y",strtotime($etudiant['dateNaiss'])) ?></td>
                                        <td class="sexe"><?= $etudiant['sexe'] ?></td>
                                        <td class="serieBac"><?= $etudiant['serieBac'] ?></td>
                                        <td class="resultat"><?= $etudiant['resultat'] ?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <input type="submit" id="buttFormAll" value="Envoyer" hidden>
                        </form>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div><!--Fin resultats recherche -->
    </div><!-- panel-group -->
</div>

<?php

$scripts = "
<script type='text/javascript' src='js/resultats.js'></script>
";
require_once 'partials/footer.php';
?>