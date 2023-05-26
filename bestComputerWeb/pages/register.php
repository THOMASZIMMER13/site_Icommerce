<?php
$title = "Inscription";
include_once("head.php");

$erreur = "";
$valid = true;

// S'il y a une session alors on ne retourne plus sur cette page
if (isset($_SESSION['id'])) {
  header('Location: index.php');
  exit;
}

if (isset($_REQUEST['email'], $_REQUEST['pass'], $_REQUEST['repass'], $_REQUEST['lastname'], $_REQUEST['firstname'])) {
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
  if (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)) {
    $valid = false;
    $erreur = $erreur . "<p>Le format du mail est incorrect</p>";
  }
  //vérification si le mail est déjà dans la base.
  $checkMail = mysqli_query($conn, "SELECT email FROM user WHERE email = '" . $email . "' limit 1");
  $existingMail = mysqli_fetch_assoc($checkMail);
  if ($existingMail) {
    $valid = false;
    $erreur = $erreur . "<p>" . $email . " est déjà utilisée</p>";
  }


  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $pass = stripslashes($_REQUEST['pass']);
  $pass = mysqli_real_escape_string($conn, $pass);

  // récupérer la confirmation du mot de passe et supprimer les antislashes ajoutés par le formulaire
  $repass = stripslashes($_REQUEST['repass']);
  $repass = mysqli_real_escape_string($conn, $repass);
  //vérifier que le mot de passe et la confirmation son identique
  if ($pass != $repass) {
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
    $query = "INSERT into user (firstname, lastname, email, role, male, pass)              VALUES ('$firstname', '$lastname', '$email', 'client', true, '$pass');";
    // Exécute la requête sur la base de données
    try {
      $res = mysqli_query($conn, $query);
      if ($res) {
        header('Location: validation.php?case=register');
      }
    } catch (Exception $err) {
      $erreur = "Une erreur s'est produite vueillez revenir plus tard sur cette page";
    }
  }
}
?>

<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8" style="padding-top: 2em">
      <h1 class="box-title">Inscription</h1>
      <div class="alert alert-primary" role="alert">
        <i class="bi bi-info-circle"></i>
        <span>Déjà inscrit ? <a href="connection.php">Se connecter !</a></span>
      </div>
      <?php if (!empty($erreur)) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-circle-fill" style="margin-right:10px"></i>
          <?php echo $erreur; ?>
        </div>
      <?php } ?>
      <form class="box" action="" method="post" class="grid">
        <div class="mb-4 row">
          <label for="genra" class="col-sm-4 col-form-label">Vous êtes :</label>
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
<?php include_once("footer.php"); ?>