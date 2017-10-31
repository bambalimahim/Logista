<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Logista | <?= $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css"/>
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
	<?= $stylesheets ?>

<body>
<div class="container navigation">
	<div class="row navigation">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand">
					LOGESTA
				</a>
			</div>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div id="navbar-collapse-1" class="navbar-collapse collapse navbar-right">
				<ul class="nav navbar-nav">
					<li class="">
						<a href="index.php">
							<span class="glyphicon glyphicon-home"></span>
							Accueil
						</a>
					</li>
					<li class="">
						<a href="recherche.php">
							<span class="glyphicon glyphicon-search"></span>
							Recherche
						</a>
					</li>
					<li class="">
						<a href="login.php">
							<span class="glyphicon glyphicon-user"></span>
							<?php
							if(isset($_SESSION['Auth']['user'])){
								echo 'Deconnexion';
							}else{
								echo 'Connexion';
							}
							?>
						</a>
					</li>
					<li>'     '</li>
					<!--<li><a href="#"></a></li>-->
				</ul>
			</div>
		</nav>
	</div><!--row navigation-->
</div><!--container navigation-->

<div class="container-fluid col-xs-offset-1 col-xs-10">
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<?php echo flash(); ?>

