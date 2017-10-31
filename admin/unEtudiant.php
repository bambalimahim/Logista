<?php

require_once '../lib/includes.php';
require_once 'etudiant.php';

if(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];

    $etudiant = unEtudiant($db, $id);;

    echo json_encode($etudiant);

}