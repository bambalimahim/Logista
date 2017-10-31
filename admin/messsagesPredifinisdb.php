<?php

function getAllpredefinedMessages($db){
    $req = $db->query("SELECT * FROM predefinedMessages");
    return $req->fetchAll();
}

function getpredefinedMessage($db, $id){
    $req = $db->query("SELECT * FROM predefinedMessages WHERE id= $id");
    $predefinedMessage = $req->fetch();
    return $predefinedMessage;
}

function addPredefinedMessage($db, $object, $content){
    $object = $db->quote($object);
    $content = $db->quote($content);
    $requete = $db->query("insert into predefinedMessages(id, object, content) values ('',$object,$content)");
    return $requete;
}

function updatePredefinedMessage($db, $id, $object, $content){
    $id = $db->quote($id);
    $object = $db->quote($object);
    $content = $db->quote($content);
    $requete = $db->query("UPDATE predefinedMessages set object=$object,content=$content where id=$id");
    return $requete;
}

function deletePredefinedMessage($db, $id){
    $id = $db->quote($id);
    $requete = $db->query("DELETE FROM predefinedMessages WHERE id=$id");
    return $reponse;
}