<?php
require_once "lib/includes.php";
require_once "classes/BDD.php";
if (!isset($_SESSION['resArray'])) {
    header("location: resultats.php");
    die();
}
$resArray = $_SESSION['resArray'];
$formStat = $_SESSION['formStat'];
$totalRes = $_SESSION['totalRes'];

//echo "</pre>";

$stylesheets = "
<link rel='stylesheet' type='text/css' href='css/recherche.css'/>
"
;
$title = "Statistiques";
if($_SESSION['Auth']['user']['statut']=='Admin'){
    require_once 'partials/admin_header_gen.php';
}else{
    require_once 'partials/header.php';
}

?>

<div class="row col-xs-2 text-center pull-right" style="margin-top: -145px">
    <div>
        <a href="formatExcel.php" target="_blank"><button class="btn btn-primary" type="submit"><i class="fa fa-file-excel-o"></i> Exporter en Excel</button></a>
    </div>
</div>

<div class="row col-xs-12" style="margin: auto;margin-top: -100px">


    <div class="row panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default"><!--Resultast recherche -->
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" id="z" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-chevron-down"></i>
                        <h4><span class="glyphicon glyphicon-education"></span> Tableau Statistique </h4>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="box-body table-responsive no-padding well" style="overflow-x:auto;">
                        <!--le tableau ici-->
                        <table border="1" style="width: 100% ; margin: auto;border-collapse: collapse; text-align: center; border-color: #00a7d0; font-family: 'Yu Mincho'">
                            <tr>
                                <td>
                                    <?php
                                    $champs = array();
                                    $elt=0;
                                    echo BDD::tableauStat($resArray, $resArray, $formStat, 0, $champs,$totalRes);
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div><!--Fin resultats recherche -->

        <div class="panel panel-default"><!--Resultast recherche -->
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a role="button" id="z" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-chevron-down"></i>
                        <h4><span class="glyphicon glyphicon-stats"></span> Graphes de la Recherche </h4>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="box-body table-responsive no-padding">
                        <div id="container" style="width:100%; margin: auto; padding:50px"></div>
                        <div id="container1" style="width:100%; margin: auto;padding:50px"></div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div><!--Fin resultats recherche -->


    </div><!-- panel-group -->
</div>

<?php
$scripts = "
<script type='text/javascript' src='js/highcharts.js'></script>
<script type='text/javascript' src='js/highchart-exporting.js'></script>
<script type='text/javascript' src='js/graph.js'></script>

	";
require_once 'partials/footer.php';


?>
