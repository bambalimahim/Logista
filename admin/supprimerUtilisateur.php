<?php
require_once '../lib/includes.php';
require_once 'utilisateur.php';
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