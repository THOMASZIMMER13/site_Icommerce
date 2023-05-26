<?php
$title = "Inscription";
include_once("../head.php");
include_once("validateAuth.php");
// require('../../bd/config.php');

$erreur = "";
$valid = true;

if (isset($_REQUEST['email'], $_REQUEST['pass'], $_REQUEST['repass'], $_REQUEST['lastname'], $_REQUEST['firstname'])) {
  /**
   * Récupération des datas
   * LASTNAME
   * FIRSTNAME
   * EMAIL
   * PASSWORD
   * CONFIRMATION PASSWORD
   * GENRE
   */
  $lastname = mysqli_real_escape_string($conn, stripslashes($_REQUEST['lastname']));
  $firstname = mysqli_real_escape_string($conn, stripslashes($_REQUEST['firstname']));
  $email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email']));
  $pass = mysqli_real_escape_string($conn, $stripslashes($_REQUEST['pass']));
  $repass = mysqli_real_escape_string($conn, stripslashes($_REQUEST['repass']));
  $male = ($_REQUEST['genra'] == 'male') ? 1 : 0;

  // Vérification du mail
  if (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)) {
    $valid = false;
    $erreur = $erreur . "<p>Le format du mail est incorrect</p>";
  }

  // Vérification si le mail est déjà dans la base.
  $checkMail = mysqli_query($conn, "SELECT email FROM user WHERE email = '" . $email . "' limit 1");
  $existingMail = mysqli_fetch_assoc($checkMail);
  if ($existingMail) {
    $valid = false;
    $erreur = $erreur . "<p>" . $email . " est déjà utilisée</p>";
  }

  // Vérifier que le mot de passe et la confirmation son identique
  if ($pass != $repass) {
    $valid = false;
    $erreur = $erreur . "<p>Les mots de passe saisis ne correspondent pas</p>";
  }

  if ($valid) {
    //requéte SQL + mot de passe crypté
    /*$query = "INSERT into 'user' (firstname, lastname, email, role, male, pass) VALUES ('$firstname', '$lastname', '$email', 'client', '$male','".hash('sha256', $pass)."')";*/
    $query = "INSERT into user (firstname, lastname, email, role, male, pass)
              VALUES ('$firstname', '$lastname', '$email', 'employe', true, '$pass');";
    // Exécute la requête sur la base de données
    try {
      $res = mysqli_query($conn, $query);
      if ($res) {
        header('Location: ../validation.php?case=register');
      }
    } catch (Exception $err) {
      $erreur = "Une erreur s'est produite veuillez revenir plus tard sur cette page";
    }
  }
} ?>
<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8" style="padding-top: 2em">
      <h1 class="box-title">Création d'un nouvel employé</h1>
      <?php if (!empty($erreur)) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-circle-fill" style="margin-right:10px"></i>
          <?php echo $erreur; ?>
        </div>
      <?php } ?>
      <form class="box" action="" method="post" class="grid">
        <div class="mb-4 row">
          <label for="genra" class="col-sm-4 col-form-label">Genre :</label>
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-3">
                <input class="form-check-input" type="radio" id="male" value="male" name="genra" checked>
                <label class="form-check-label" for="male">Un Homme</label>
              </div>
              <div div class="col-sm-3">
                <input class="form-check-input" type="radio" id="female" value="female" name="genra">
                <label class="form-check-label" for="female">Une Femme</label>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-4 row">
          <label for="lastname" class="col-sm-4 col-form-label">Nom *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" id="lastname" name="lastname" required="true" aria-required="true" minlength="2" maxlength="20">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="firstname" class="col-sm-4 col-form-label">Prénom *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" id="firstname" name="firstname" required="true" aria-required="true" minlength="2" maxlength="30">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="email" class="col-sm-4 col-form-label">Email *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="email" id="email" name="email" required="true" aria-riquired="true" placeholder="example@gmail.com" maxlength="30">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="pass" class="col-sm-4 col-form-label">Mot de passe *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="password" class="box-input" id="pass" name="pass" required="true" aria-required="true" minlength="8" maxlength="50">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="repass" class="col-sm-4 col-form-label">Confirmation du mot de passe *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="password" class="box-input" id="repass" name="repass" required="true" aria-required="true" minlength="8" maxlength="50">
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <input type="submit" name="submit" value="Soumettre" class="btn btn-sm btn-success" />
        </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>
<?php include_once("../footer.php"); ?>