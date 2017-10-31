<?php

require_once '../lib/includes.php';

function ajouterEtudiant($db, $data){
    $requete = $db->prepare("INSERT INTO etudiant(cni,nationalite, prenom, nom, sexe, dateNaiss, paysNaiss, lieuNaiss, numTel, serieBac)
    VALUES(?,?,?,?,?,?,?,?,?,?) ");
    $reponse = $requete->execute([$data['cni'],$data['nationalite'], $data['prenom'],$data['nom'],$data['sexe'],$data['dateNaiss'],$data['paysNaiss'],$data['lieuNaiss'],$data['numTel'],$data['serieBac']]);
    $id = $db->lastInsertId();
    return $id;
}

function ajouterInfoAnnuelles($db, $idEtudiant, $data){
    $requete1 = $db->prepare("INSERT INTO infosannuelles(idEtudiant, annee, nomDept, nomOption, formation, niveau, nature, priseEnCharge, resultat,matricule)
    VALUES(?,?,?,?,?,?,?,?,?,?) ");
    $reponse1 = $requete1->execute([$idEtudiant,$data['annee'],$data['nomDept'],$data['nomOption'],$data['formation'],$data['niveau'],$data['nature'],$data['priseEnCharge'],$data['resultat'],$data['matricule']]);

    return $reponse1;
}

function ajouterEtudiantTout($db, $data){
    $idEtudiant = ajouterEtudiant($db, $data);
    if($idEtudiant){
        $id = ajouterInfoAnnuelles($db, $idEtudiant, $data);
        if($id){
            return true;
        }
        else{
            return false;
        }
    }else{
        return false;
    }
}

function selectEtudiant($db, $id){
    $requete = $db->query("SELECT * FROM etudiant WHERE id= $id");
    $etudiant = $requete->fetch(PDO::FETCH_ASSOC);
    return $etudiant;
}

function infoAnnuelles($db, $idEtudiant){
    $requete = $db->query("SELECT * FROM infosAnnuelles WHERE idEtudiant= $idEtudiant");
    $infos = $requete->fetch(PDO::FETCH_ASSOC);
    return $infos;
}

function unEtudiant($db, $id){
    $requete = "SELECT * FROM etudiant as e,infosAnnuelles as i WHERE e.id = i.idEtudiant AND e.id = ?";
    $requete = $db->prepare($requete);
    $reponse = $requete->execute([$id]);
    $etudiant = $requete->fetch(PDO::FETCH_ASSOC);

    return $etudiant;
}
function tousEtudiant($db){
    $requete = "SELECT * FROM etudiant as e,infosAnnuelles as i WHERE e.id = i.idEtudiant";
    $requete = $db->prepare($requete);
    $reponse = $requete->execute();
    $etudiant = $requete->fetchAll(PDO::FETCH_ASSOC);

    return $etudiant;
}



function modifierEtudiant($db, $data){
    $requete = $db->prepare("UPDATE etudiant  set cni = ?, nationalite = ?, prenom = ?, nom = ?, sexe = ?, dateNaiss = ?, paysNaiss = ?, lieuNaiss = ?, numTel = ?, serieBac = ? WHERE id = ?");
    $reponse = $requete->execute([$data['cni'],$data['nationalite'],$data['prenom'],$data['nom'],$data['sexe'],$data['dateNaiss'],$data['paysNaiss'],$data['lieuNaiss'],$data['numTel'],$data['serieBac'],$data['id']]);

    $requete1 = $db->prepare("UPDATE infosannuelles set  annee = ?, nomDept = ?, nomOption = ?, formation = ?, niveau = ?, nature = ?, priseEnCharge = ?, resultat = ? , dateDeliberation = ? , matricule = ? WHERE idEtudiant = ?");
    $reponse1 = $requete1->execute([$data['annee'],$data['nomDept'],$data['nomOption'],$data['formation'],$data['niveau'],$data['nature'],$data['priseEnCharge'],$data['resultat'],$data['dateDeliberation'],$data['matricule'], $data['id']]);

    return $reponse1 && $reponse;

}