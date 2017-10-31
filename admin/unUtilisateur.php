<?php

require_once '../lib/includes.php';
require_once 'utilisateur.php';

if(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];

    $utilisateur = selectUtilisateur($db, $id);;

    echo json_encode($utilisateur);

}