<?php
session_start();
if(!isset($auth)){
    if(!isset($_SESSION['Auth']['user'])) {
        header('location:'.WEBROOT.'login.php');
        die();
    }
}
if(!isset($_SESSION['csrf'])){
    $_SESSION['csrf']=md5(time()+rand());
}

function csrf(){
    if(isset($_SESSION['csrf'])){
      return 'csrf='.$_SESSION['csrf'];
    }
}

function checkCsrf(){
    if( !isset($_GET['csrf']) OR ( isset($_GET['csrf']) && ($_GET['csrf'])!=$_SESSION['csrf'] ) ) {
        header('location:csrf.php');
        die();
    }
}