<?php
$url = $_SERVER['SCRIPT_NAME'];
$url = explode('/', $url);
if(count($url)>=3){
    $root = "";
    for($i=1;$i<count($url)-1;$i++){
        $root.=$url[$i].'/';
    }
    define('WEBROOT','/'.$root );
}else{
    define('WEBROOT','/'.$url[1].'/' );
}
//var_dump(WEBROOT);
//die();