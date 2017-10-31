<?php
function flash(){
    if(isset($_SESSION['flash'])){
        extract($_SESSION['flash']);
        unset($_SESSION['flash']);
        return "
        <div style='position:absolute; top: 12%; margin: auto; left: 44%;' class='alert alert-close alert-dismissable alert-$type alert-dismissable'>
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
            $message 
         </div>";
    }
}
function setFlash($message,$type='success'){
    $_SESSION['flash']['message'] = $message;
    $_SESSION['flash']['type'] = $type;
}
function setSearchResults($array){
    if(isset($_SESSION['searchReasults'])){
        unset($_SESSION['searchReasults']);
        $_SESSION['searchReasults']=$array;
    }else{
        $_SESSION['searchReasults']=$array;
    }
}
function getSearchResults(){
    if(!isset($_SESSION['searchReasults'])){
        return [];
    }
    return $_SESSION['searchReasults'];
}
