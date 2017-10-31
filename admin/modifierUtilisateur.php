<?php
require_once '../lib/includes.php';
require_once 'utilisateur.php';
$user = null;
if(isset($_GET['id'])){
    $user = selectUtilisateur($db, $_GET['id']);
}


if(isset($_POST) && !is_null($_POST) && isset($_POST['id'])){
    $id = modifierUtilisateur($db, $_POST);
    if($id == true) {
        setFlash('Modification reussie');
        header('location:indexUtilisateur.php');
        die();

    }
    else{
        setFlash('Echec de la modification', 'danger');
        header('location:ajouterUtilisateur.php');
        die();
    }


}

$stylesheets = "
<link rel='stylesheet' type='text/css' href='../css/resume1.min.css'/>
<link rel='stylesheet' type='text/css' href='../css/recherche.css'/>
<link rel='stylesheet' type='text/css' href='../css/index.css'/>";
$title = "Ajouter un Utilisateur";
require_once '../partials/admin_header.php';
?>
<div class="row panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<form action="" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="id" class="control-label col-sm-2"></label>
        <div class="col-sm-6">
            <input type="hidden" name="id" class="form-control" value="<?php echo isset($user['id'])?  $user['id']: null ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="control-label col-sm-2">E-mail :</label>
        <div class="col-sm-6">
            <input type="text" name="email" class="form-control" value="<?php echo isset($user['email']) ?  $user['email']: null ?>">
        </div>
    </div>
    <!--
    <div class="form-group">
        <label for="password" class="control-label col-sm-2">Mot de passe :</label>
        <div class="col-sm-6">
            <input type="text" name="password" class="form-control" ">
        </div>
    </div>

    <div class="form-group">
        <label for="confirmation_password" class="control-label col-sm-2">Confirmez votre mot de passe :</label>
        <div class="col-sm-6">
            <input type="text" name="confirmation_password" class="form-control" ">
        </div>
    </div>
    -->
    <div class="form-group">
        <label for="" class="control-label col-sm-2"></label>
        <div class="col-sm-6">
            <select name="statut" id="" class="form-control">
                <option value="Admin" <?php echo $user['statut'] == "Admin" ? "selected" : null ; ?>>Administrateur</option>
                <option value="Simple utilisateur" <?php echo $user['statut'] == "Simple utilisateur" ? "selected" : null ; ?>>Simple utilisateur</option>
            </select>
        </div>
    </div>



    <div class="form-group">
        <label for="" class="control-label col-sm-2"></label>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary">Modifier un utilisateur</button>
        </div>
    </div>
</form>
</div>

<?php
$scripts = "";
require_once '../partials/footer_admin.php';
?>

