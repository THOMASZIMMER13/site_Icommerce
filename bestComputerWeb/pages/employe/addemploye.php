<?php
include ("validateAuth.php");
 session_start();
require('../../bd/config.php');
$erreur = "";
$valid = true;

if (isset($_REQUEST['email'], $_REQUEST['pass'], $_REQUEST['repass'], $_REQUEST['lastname'], $_REQUEST['firstname'])){
	// récupérer le nom
	$lastname = stripslashes($_REQUEST['lastname']);
	$lastname = mysqli_real_escape_string($conn, $lastname); 

  // récupérer le prénom
	$firstname = stripslashes($_REQUEST['firstname']);
	$firstname = mysqli_real_escape_string($conn, $firstname); 

	// récupérer le mail
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email); 
  // Vérification du mail
  if(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)){
    $valid = false;
    $erreur = $erreur . "<p>Le format du mail est incorrect</p>"; 
  }
  //vérification si le mail est déjà dans la base.
  $checkMail = mysqli_query($conn, "SELECT * FROM user WHERE email = '".$email."' limit 1");
  $existingMail = mysqli_fetch_assoc($checkMail);
  if($existingMail) {
    $valid = false;
    $erreur = $erreur . "<p>".$email." est déjà utilisée</p>";
  }


  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$pass = stripslashes($_REQUEST['pass']);
	$pass = mysqli_real_escape_string($conn, $pass);

  // récupérer la confirmation du mot de passe et supprimer les antislashes ajoutés par le formulaire
  $repass = stripslashes($_REQUEST['repass']);
  $repass = mysqli_real_escape_string($conn, $repass);
  //vérifier que le mot de passe et la confirmation son identique
  if($pass != $repass){
    $valid = false;
    $erreur = $erreur . "<p>Les mots de passe saisis ne correspondent pas</p>";
  }


    // récupérer le genre
	if ($_REQUEST['genra'] == 'male') {
    $male = true;
  } else {
    $male = false;
  }

	if ($valid) {
    //requéte SQL + mot de passe crypté
    /*$query = "INSERT into 'user' (firstname, lastname, email, role, male, pass) VALUES ('$firstname', '$lastname', '$email', 'client', '$male','".hash('sha256', $pass)."')";*/
    $query = "INSERT into user (firstname, lastname, email, role, male, pass)              VALUES ('$firstname', '$lastname', '$email', 'employe', true, '$pass');";
    // Exécute la requête sur la base de données
    try {
      $res = mysqli_query($conn, $query);
      if($res) {
        header('Location: ../validation.php?case=register');
      }
    } catch (Exception $err) {
      $erreur = "Une erreur s'est produite vueillez revenir plus tard sur cette page";
    }
  }
} ?>

<?php 
  $title = "Inscription";
  include ("head.php"); 
?>

<div class="container">
<div class="row">
<div class="col-2"></div>
<div class="col-8" style="padding-top: 5em">
  <form class="box" action="" method="post">

    <h1 class="box-title">Inscrire le nouvel employé</h1>
    <p><?php  echo $erreur ?></p>
    <div class="form-group">
      <fieldset>
        <legend>Vous êtes:</legend>
        <input type="radio" id="male" value="male" name="genra" checked>
        <label for="male">Un Homme</label>
        <input type="radio" id="female" value="female" name="genra">
        <label for="female">Une Femme</label
      </fieldset>
    </div>
    <div class="form-group">
      <label for="lastname">Votre Nom *: </label>
      <input type="text" id="lastname" name="lastname" required="true" aria-required="true" minlength="2" maxlength="20">
    </div>
    <div class="form-group">
      <label for="firstname">Votre Prénom *:</label>
      <input type="text" id="firstname" name="firstname" required="true" aria-required="true" minlength="2" maxlength="30">
    </div>
    <div class="form-group">
      <label for="email">Email *:</label>
      <input type="email" id="email" name="email" required="true" aria-riquired="true" placeholder="example@gmail.com" maxlength="30">
    </div>
    <div class="form-group">
      <label for="pass">Mot de Passe *:</label>
      <input type="password" class="box-input" id="pass" name="pass" required ="true" aria-required="true" minlength="8" maxlength="50">
	  </div>
    <div class="form-group">
      <label for="repass">Confirmer le mot de Passe *:</label>
      <input type="password" class="box-input" id="repass" name="repass" required ="true" aria-required="true" minlength="8" maxlength="50">
    </div>
    <input type="submit" name="submit" value="Soumettre" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="connection.php">Se connecter</a></p>
</form>
</div>
<div class="col-2"></div>


</div>
</div>
<?php include ("footer.php"); ?>