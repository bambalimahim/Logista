<?php
require_once 'lib/includes.php';
header('Content-Type: text/html; charset=utf-8');
$resultats = getSearchResults();
/*echo "<pre>";
var_dump($resultats);
echo "</pre>";
die();
*/

$stylesheets = "
<!-- DataTables -->
<link rel='stylesheet' href='plugins/datatables/dataTables.bootstrap.css'>
";
$stylesheets .= "

<link rel='stylesheet' type='text/css' href='css/recherche.css'/>

"
;
$title = "Résultats de la Recherche l";
if($_SESSION['Auth']['user']['statut']=='Admin'){
    require_once 'partials/admin_header_gen.php';
}else{
    require_once 'partials/header.php';
}

?>

    <div class="row col-xs-12" style="margin: auto; margin-top: -50px">

        <!--<div class="modal fade" id="geolocalisation" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Generation de rapports pour les étudiants sélectionnés</h4>
                    </div>
                    <div class="modal-body">
                        -->
        <div id="map" style="width:100%;height:500px"></div>
        <!--</div>
    </div>
    <!-- /.modal-content -->
        <!--
        </div>
        <!-- /.modal-dialog -->
        <!--</div>-->

    </div>

<?php
$scripts = "
<script type='text/javascript' src='js/resultats.js'></script>
<script>
function myMap() {
    /*var mapCanvas = document.getElementById(\"map\");
    var mapOptions = {
    center: new google.maps.LatLng(51.5, -0.2), 
    zoom: 10
    }*/
//    13.8067478,-13.7719029,7z
//  var myLatLng = {lat: -25.363, lng: 131.044};
//  var map = new google.maps.Map(mapCanvas, mapOptions);
    var myLatLng = {lat: 13.8067478, lng: -13.7719029};
    var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          scrollwheel: true,
          zoom: 3
        });

    console.log(locations);
    /*
    var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    // A commenter pour avoir les marqueur par defaut -----------------
    var markers = locations.map(function(location, i) {
      return new google.maps.Marker({
        position: location,
        label: labels[i % labels.length]
      });
    });   
       
    var markerCluster = new MarkerClusterer(map, markers,
    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    */
    //-------------------------------
    
    // A commenter pour avoir les cluster---------
    
    $.ajax({
        url : 'locationMap.php',
        success : function (donnees) {
            data = $.parseJSON(donnees);
            console.log(data);

            var mapOptions = {
                zoom: 4
            };
            data.forEach(function(donnee)
                {
                    for (var iter = 0; iter < donnee.nbLieu; iter++) {
                        locations.push(donnee.location);
                    }
                     
                    //console.log(donnee.location);
                   
                    if (donnee.location.lat!=0 && donnee.location.lng!=0) {
                        var marker = new google.maps.Marker({
                            position: donnee.location,
                            title:donnee.paysNaiss.concat('/'.concat(donnee.lieuNaiss)),
                            label: donnee.nbLieu.toString(),
                            map:map
                        }); 
                        marker.timestamp = \"1\";
                        // To add the marker to the map, call setMap();
                        marker.setMap(map);
                    }
                    
                    
                }
            );
            
        }
    });
    //------------------------------
    
}
var locations = [];
/*
$.ajax({
        url : 'locationMap.php',
        success : function (donnees) {
            data = $.parseJSON(donnees);
            console.log(data);

            var mapOptions = {
                zoom: 4
            };
            data.forEach(function(donnee)
                {
                    for (var iter = 0; iter < donnee.nbLieu; iter++) {
                        locations.push(donnee.location);
                    }
                
                    /*
                    var marker = new google.maps.Marker({
                        position: donnee.location,
                        title:\"Hello World!\",
                        label: donnee.nbLieu,
                        map:map
                    });
                    marker.timestamp = \"1\";
                    // To add the marker to the map, call setMap();
                    marker.setMap(map);
                    */
                    /*
                }
            );
            
        }
    });*/
</script>
<script src=\"https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js\">
    </script>
<script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyB_-ScihUvuHkcIRWOvDbSVqHZt0P8yDHM&callback=myMap\" async defer></script>
<!--<script type='text/javascript' src='js/jquery.dynatable.js'></script>
<script>
    $(document).ready(function() {
        $('#my-table').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': true,
          'ordering': true,
          'info' : true,
          'autoWidth' : false
        });
    });
</script>-->
	";
require_once 'partials/footer.php';
?>