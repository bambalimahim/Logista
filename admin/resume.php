<?php
require '../lib/includes.php';
$title ="Résumé";
$stylesheets = "
<!-- DataTables -->
<link rel='stylesheet' href='../plugins/datatables/dataTables.bootstrap.css'>
";
require '../partials/admin_header_v2.php';
/*if(isset($_GET['page'])) {
    $page=$_GET['page'];
    $offset = ($_GET['page'] - 1) * 15;
}
else{
    $offset = 1;
}*/
$etudiants = $db->query("SELECT i.matricule,e.cni,e.prenom,e.nom,e.sexe,DATE_FORMAT(e.dateNaiss,'%d-%m-%Y') AS dateNaissfr, e.paysNaiss,e.lieuNaiss,
            i.nomDept as departement,i.formation,i.niveau,i.nature,i.nomOption
            FROM 
            etudiant e, infosAnnuelles i
            WHERE e.id=i.idEtudiant
            ");
$etudiants = $etudiants->fetchAll();
/*$nbpages = ceil($db->query("SELECT COUNT(*) FROM etudiant")->fetchColumn()/15);*/
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Logesta
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tableau de Bord </a></li>
        <li class="active">Base de Données</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <!--<div class="box-header">
            <h3 class="box-title"></h3>
        </div> /.box-header -->
        <div class="box-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Matricule</th>
                    <th>CNI</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Genre</th>
                    <th>DateNaiss</th>
                    <th>PaysNaiss</th>
                    <th>LieuNaiss</th>
                    <th>Département</th>
                    <th>Option</th>
                    <th>Formation</th>
                    <th>Niveau</th>
                    <th>Nature</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($etudiants as $etudiant) : ?>
                    <tr>
                        <td><?= $etudiant['matricule'] ?></td>
                        <td><?= $etudiant['cni'] ?></td>
                        <td><?= $etudiant['prenom'] ?></td>
                        <td><?= $etudiant['nom'] ?></td>
                        <td><?= $etudiant['sexe'] ?></td>
                        <td><?= $etudiant['dateNaissfr'] ?></td>
                        <td><?= $etudiant['paysNaiss'] ?></td>
                        <td><?= $etudiant['lieuNaiss'] ?></td>
                        <td><?= $etudiant['departement'] ?></td>
                        <td><?= $etudiant['nomOption'] ?></td>
                        <td><?= $etudiant['formation'] ?></td>
                        <td><?= $etudiant['niveau'] ?></td>
                        <td><?= $etudiant['nature'] ?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
                <!--<tfoot>
                <tr>
                    <th>Matricule</th>
                    <th>CNI</th>
                    <th>prenom</th>
                    <th>nom</th>
                    <th>sexe</th>
                    <th>dateNaissFr</th>
                    <th>paysNaiss</th>
                    <th>lieuNaiss</th>
                    <th>departement</th>
                    <th>nomOption</th>
                    <th>formation</th>
                    <th>niveau</th>
                    <th>nature</th>
                </tr>
                </tfoot>-->
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section>
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
    });
</script>
";
require_once '../partials/footer_admin_v2.php';
?>