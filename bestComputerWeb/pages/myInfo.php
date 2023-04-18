<?php
 session_start();
require('../bd/config.php');
$result = '';
$lastname ="";
$firstname ="";
$email ="";
$male ="";
$pass="";
$erreur = "";
$valid = true;
  $user = null;
$id=0;

//récupérer l'id de l'utilisateur actuellement connecté
 if($_SESSION['email'] ){
  $query = "SELECT * FROM user WHERE email = '".$_SESSION["email"]."' limit 1";
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);
  $id = $user["id"];
  if (!$user) {
    header("Location: error.php");
  }
 } else {
   header("Location: error.php");
 }

if (isset($_REQUEST['id'], $_REQUEST['email'], $_REQUEST['pass'], $_REQUEST['repass'], $_REQUEST['lastname'], $_REQUEST['firstname'])){
//récupérer id
$id = stripslashes($_REQUEST['id']);
	$id = mysqli_real_escape_string($conn, $id); 

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

    // récupérer le genre
	if ($_REQUEST['genra'] == 'male') {
    $male = true;
  } else {
    $male = false;
  } 

$id ='$_SESSION["id"]';
//$id =$user['id'];
	//requéte SQL
if ($id > 0) {
  $query = "UPDATE user set firstname=".$firstname.", lastname=".$lastname.", email=".$email.", pass=".$pass.", role=".$role.", male=".$male." WHERE id = ".$id;
} else {
    $erreur = $erreur . "<p>il y a eu une erreur </p>"; 
}

    // Exécute la requête sur la base de données
    try {
      $res = mysqli_query($conn, $query);
      $result = $res;
      if($res) {
         $result = 'Modification de vos informations effectué';
      }
    } catch (Exception $err) {
      $result = $err;
    }
  }
else if (isset($id)) {
  $query = "SELECT * FROM user WHERE id = " . $id;
  $res = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($res);
  if ($data) {
    $id = $data["id"];
    $male= $data["male"];
    $lastname = $data["lastname"];
    $firstname = $data["firstname"];
    $email = $data["email"];
    $pass = $data["pass"];
  }
} 
?>

<?php 
  $title = "Mes informations";
  include ("head.php"); 
?>

<div class="container">
<div class="row">
<div class="col-2"></div>
<div class="col-8" style="padding-top: 5em">
  <form class="box" action="" method="post">

    <h1> Mes informations</h1>
    <p><?php  echo $erreur ?></p>
 <p><?php  echo $result ?></p>
 <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <fieldset>
        <legend>Vous êtes:</legend>
        <input type="radio" id="male" value="male" name="genra" checked>
        <label for="male">Un Homme</label>
        <input type="radio" id="female" value="female" name="genra">
        <label for="female">Une Femme</label>
      </fieldset>
    </div>
    <div class="form-group">
      <label for="lastname">Votre Nom *: </label>
      <input type="text" id="lastname" name="lastname" required="true" aria-required="true" minlength="2" maxlength="20" value="<?php echo $lastname; ?>">
    </div>
    <div class="form-group">
      <label for="firstname">Votre Prénom *:</label>
      <input type="text" id="firstname" name="firstname" required="true" aria-required="true" minlength="2" maxlength="30" value="<?php echo $firstname; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email *:</label>
      <input type="email" id="email" name="email" required="true" aria-required="true" placeholder="example@gmail.com" maxlength="30" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label for="pass">Mot de Passe *:</label>
      <input type="password" class="box-input" id="pass" name="pass" required ="true" aria-required="true" minlength="8" maxlength="50" value="<?php echo $pass; ?>">
	  </div>
    <input type="submit" name="submit" value="Soumettre" class="box-button" />
</form>
</div>
<div class="col-2"></div>


</div>
</div>

<?php include ("footer.php"); ?>