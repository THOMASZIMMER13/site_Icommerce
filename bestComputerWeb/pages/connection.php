<?php
$title = "Connexion";
include_once("head.php");

// require('..\bd\config.php');

// session_start();
//variables
@$email = $_POST["email"];
//@$pass=sha1 ($_POST["password"]);
@$pass = $_POST["password"];
@$valider = $_POST["valider"];
$erreur = "";
$data = null;

if (isset($valider)) {
  // récupérer le mail
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
  // Vérification du mail

  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $pass = stripslashes($_REQUEST['password']);
  $pass = mysqli_real_escape_string($conn, $pass);

  $query = "select id, role, male, lastname, firstname, email, pass from user where email='" . $email . "' and pass='" . $pass . "' limit 1";

  try {
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);
    if ($data) {
      $_SESSION["prenomnom"] = ucfirst(strtolower($data["firstname"])) . " " . strtoupper($data["lastname"]);
      $_SESSION["authorized"] = true;
      $_SESSION["role"] = $data["role"];
      $_SESSION["email"] = $data["email"];
      $_SESSION["id"] = $data["id"];
      if ($data["role"] == "client") {
        header("Location: customer-dashboard.php");
        exit;
      }
      header("Location: employee-dashboard.php");
      exit;
    } else {
      $erreur = "Mauvais login ou mot de passe !";
    }
  } catch (Exception $err) {

    $erreur = $err;
    $erreur = 'erreur lors de la tentative de connexion';
  }
}
?>

<div id="container" class="container align-content-center">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8" style="padding-top: 2em">
      <h1>Connexion </h1>
      <?php if (!empty($erreur)) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-circle-fill" style="margin-right:10px"></i>
          <?php echo $erreur; ?>
        </div>
      <?php } ?>
      <div class="alert alert-primary" role="alert">
        <i class="bi bi-info-circle"></i>
        <span>Pas encore de compte ? <a href="register.php">Inscrivez-vous!</a></span>
      </div>
      <form name="fo" method="post" action="" class="grid">
        <!-- <div class="col-md-4"></div> -->
        <div class="mb-4 row">
          <label for="login" class="col-sm-4 col-form-label">Email *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="email" placeholder="example@gmail.com" id="login" name="email" required="true" aria-required="true">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="pass" class="col-sm-4 col-form-label">Mot de passe *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="password" placeholder="Entrer le mot de passe" id="pass" name="password" required="true" aria-required="true">
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
          <input class="btn btn-sm btn-outline-danger" type="reset" name="effacer" placeholder="effacer" />
          <input class="btn btn-sm btn-success" type="submit" name="valider" placeholder="Envoyer" />
        </div>
        <!-- <div class="col-md-4"></div> -->
      </form>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>