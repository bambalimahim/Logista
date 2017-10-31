<?php
try{
    /*
    $db = new PDO('mysql:host=pm239676-001.privatesql;port=35347;dbname=mbodjBD','mbodj','Passer2017');*/
    $db = new PDO('mysql:host=localhost;dbname=logista','root','');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING );
}catch(Exception $e){
    echo 'Connexion base de données impossible';
    echo $e->getMessage();
}
$db->query("SET NAMES 'utf8'");