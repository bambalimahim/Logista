<?php
$auth=0;
require_once('lib/includes.php');
$_SESSION=array();
if(isset($_POST['email']) && isset($_POST['password'])){
    $email=$db->quote($_POST['email']);
    $password=htmlspecialchars($_POST['password']);
    $password = sha1($password);
    $sql="SELECT * from utilisateurs WHERE email=$email AND password='$password'";
    $select= $db->query($sql);
    if($select->rowCount()>0){
        $_SESSION['Auth']['user']=$select->fetch();
        setFlash('Bienvenue '.$_SESSION['Auth']['user']['email'].'!');
        if($_SESSION['Auth']['user']['statut']=='Admin'){
            header('location:admin/index.php');
            die();
        }
        else{
            header('location:recherche.php');
            die();
        }
    }else{
        setFlash('Login ou Mot de Passe Incorrect','danger');
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>

    <title>Logesta | Connexion </title>
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/purpleloginstyle.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- -->
    <script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>$(document).ready(function(c) {
            $('.alert-close').on('click', function(c){
                $('.message').fadeOut('slow', function(c){
                    $('.message').remove();
                });
            });
        });
    </script>
</head>
<body>
<?= flash() ?>
<!-- contact-form -->
<div class="message warning" >
    <div class="inset">
        <div class="login-head">
            <h1>Logesta</h1>
        </div>
        <form method="post" action="#">
            <li>
                <input type="text" name="email" class="text" value="Email..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email...';}"><a href="#" class=" icon user"></a>
            </li>
            <div class="clear"> </div>
            <li>
                <input type="password" name="password" value="Mot de Passe..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mot de Passe...';}"> <a href="#" class="icon lock"></a>
            </li>
            <div class="clear"> </div>
            <div class="submit">
                <input type="submit" value="Connexion" >
                <h4><a href="index.php">Retour à l'accueil</a></h4>
                <div class="clear">  </div>
            </div>

        </form>
    </div>
</div>
<div class="clear"> </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<?php if(isset($scripts)) echo $scripts ?>
</body>
</html>