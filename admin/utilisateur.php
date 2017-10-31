<?php

function selectUtilisateur($db, $id){
    $requete = $db->query("SELECT * FROM utilisateurs WHERE id= $id");
    $utillisateur = $requete->fetch(PDO::FETCH_ASSOC);
    return $utillisateur;
}
function allUtilisateur($db){
    $requete = $db->query("SELECT * FROM utilisateurs");
    $utillisateur = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $utillisateur;
}

function ajouterUtilisateur($db, $data){
    $password = '';
    if($data['password'] == $data['confirmation_password']) {
        $password = sha1($data['password']);
        $requete = $db->prepare("insert into utilisateurs(prenom, nom, email,password, statut)values(?,?,?, ?, ?)");
        $reponse = $requete->execute([$data['prenom'],$data['nom'], $data['email'], $password, $data['statut']]);

        return $reponse;
    }else{
        return false;
    }
}

function modifierUtilisateur($db, $data){
    $requete = $db->prepare("UPDATE utilisateurs set prenom=?,nom=?,email=?, statut=? where id= ?");
    $reponse = $requete->execute([$data['prenom'],$data['nom'],$data['email'], $data['statut'], $data['id']]);

    return $reponse;
}

function supprimerUtilisateur($db, $id){
    $requete = $db->prepare("DELETE FROM utilisateurs WHERE id=?");
    $reponse = $requete->execute([$_GET[id]]);

    return $reponse;
}