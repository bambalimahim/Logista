<?php

require_once '../lib/includes.php';
require_once 'messsagesPredifinisdb.php';

if(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];
    $predefinedMessage = getpredefinedMessage($db, $id);;
    echo json_encode($predefinedMessage);
}