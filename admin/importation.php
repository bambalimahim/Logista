<?php
$title ="Importation";
require '../lib/includes.php';
require '../partials/admin_header_v2.php';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Logesta
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tableau de Bord </a></li>
        <li class="active">Importation de Fichier</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?= flash() ?>
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Importation de Fichier</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="" name="import_fichier" id="import_fichier" ENCTYPE="multipart/form-data" action="verificationFichier.php" method="POST" >
            <div class="box-body">
                <div class="form-group">
                    <label for="departement">Département</label>
                    <select class="form-control selectpicker" name="departement" required>
                        <option value="GENIE INFORMATIQUE">GENIE INFORMATIQUE</option>
                        <option value="GENIE CHIMIQUE">GENIE CHIMIQUE</option>
                        <option value="GENIE CIVIL">GENIE CIVIL</option>
                        <option value="GENIE ELECTRIQUE">GENIE ELECTRIQUE</option>
                        <option value="GENIE MECANIQUE">GENIE MECANIQUE</option>
                        <option value="GESTION">GESTION</option>
                    </select><br>
                    <label for="fichierExcel">Fichier a importer (Format Excel) </label>
                    <input class="form-control" type="file" name="fichierExcel" id="fichierExcel" value="Choisir un fichier excel" accept="file/*" autofocus>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit"  id="import"  class="btn btn-primary">Importer</button>
                <button type="reset" class="btn btn-warning">Annuler</button>
            </div>
        </form>
    </div><!-- /.box -->
</section><!-- /.content -->

<?php
$scripts = "<script type='text/javascript' src='../js/import.js'></script>";
include('../partials/footer_admin_v2.php');
?>