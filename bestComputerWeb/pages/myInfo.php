<?php
$title = "Mes informations";
include_once("head.php");

$result = '';
$lastname = "";
$firstname = "";
$email = "";
$male = "";
$pass = "";
$erreur = "";
$valid = true;
$user = null;
$id = 0;

//récupérer l'id de l'utilisateur actuellement connecté
if ($_SESSION['id'] && $_SESSION['id'] !== 0) {
  $query = "SELECT id, role, male, lastname, firstname, email, pass FROM user WHERE id = " . $_SESSION['id'];
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);

  if ($user) {
    $id = $user["id"];
    $male = $user["male"];
    $lastname = $user["lastname"];
    $firstname = $user["firstname"];
    $email = $user["email"];
    $pass = $user["pass"];
  }

  if (!$user) {
    header("Location: ../error.php");
  }
} else {
  header("Location: ../error.php");
}

if (isset($_REQUEST['id'], $_REQUEST['email'], $_REQUEST['pass'], $_REQUEST['genra'], $_REQUEST['lastname'], $_REQUEST['firstname'])) {
  /* 
    * Récupération des données
    * ID
    * LASTNAME
    * FIRSTNAME
    * EMAIL
    * PASSWORD
    * GENRE
    */
  $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));
  $lastname = mysqli_real_escape_string($conn, stripslashes($_REQUEST['lastname']));
  $firstname = mysqli_real_escape_string($conn, stripslashes($_REQUEST['firstname']));
  $email = mysqli_real_escape_string($conn, stripslashes($_REQUEST['email']));
  $pass = mysqli_real_escape_string($conn, stripslashes($_REQUEST['pass']));
  $male = ($_REQUEST['genra'] == 'male') ? 1 : 0;
  // Vérification du mail
  if (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $email)) {
    $valid = false;
    $erreur = $erreur . "<p>Le format du mail est incorrect</p>";
  }
  //vérification si le mail est déjà dans la base.
  $checkMail = mysqli_query($conn, "SELECT id FROM user WHERE email = '" . $email . "' limit 1");
  $existingMail = mysqli_fetch_assoc($checkMail);
  if ($existingMail && $existingMail["id"] !== $user["id"]) {
    $valid = false;
    $erreur = $erreur . "<p>" . $email . " est déjà utilisée</p>";
  }

  // $id = '$_SESSION["id"];
  //$id =$user['id'];
  //requéte SQL
  if ($user['id'] > 0) {
    $query = "UPDATE user set firstname='" . $firstname . "', lastname='" . $lastname . "', email='" . $email . "', pass='" . $pass . "', role='" . $_SESSION['role'] . "', male=" . $male . " WHERE id = " . $user['id'];
  } else {
    $erreur = $erreur . "<p>il y a eu une erreur </p>";
  }

  // Exécute la requête sur la base de données
  try {
    $res = mysqli_query($conn, $query);
    $result = $res;
    if ($res) {
      $result = 'Modification de vos informations effectuée';
    }
  } catch (Exception $err) {
    $result = $err;
  }
} 
?>

<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="p-4 p-md-4 mb-2">
        <h2><i class="bi bi-star" style="font-size: 3rem;"></i>Mes informations</h2>
      </div>
      <?php if (!empty($erreur)) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-circle-fill"></i>
          <?php echo $erreur; ?>
        </div>
      <?php } elseif (!empty($result)) { ?>
        <div class="alert alert-success" role="alert">
          <i class="bi bi-check-lg"></i>
          <?php echo $result; ?>
        </div>
      <?php } ?>
      <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-4 row">
          <label for="address" class="col-sm-2 col-form-label">Vous êtes :</label>
          <div class="col-sm-8">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="genra" id="male" value="male" <?php echo (!empty($male) ? "checked" : "")?>>
              <label class="form-check-label" for="male">Homme</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="genra" id="female" value="female" <?php echo (!empty($male) ? "" : "checked")?>>
              <label class="form-check-label" for="female">Femme</label>
            </div>
          </div>
        </div>
        <div class="mb-4 row">
          <label for="lastname" class="col-sm-2 col-form-label">Nom *:</label>
          <div class="col-sm-8">
            <input type="text" id="lastname" name="lastname" class="form-control" required="true" aria-required="true" minlength="2" maxlength="20" value="<?php echo $lastname; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="firstname" class="col-sm-2 col-form-label">Prénom *:</label>
          <div class="col-sm-8">
            <input type="text" id="firstname" name="firstname" class="form-control" required="true" aria-required="true" minlength="2" maxlength="30" value="<?php echo $firstname; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="email" class="col-sm-2 col-form-label">Email *:</label>
          <div class="col-sm-8">
            <input type="email" id="email" name="email" class="form-control" required="true" aria-required="true" placeholder="example@gmail.com" maxlength="30" value="<?php echo $email; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="pass" class="col-sm-2 col-form-label">Mot de Passe *:</label>
          <div class="col-sm-8">
            <input type="password" id="pass" name="pass" class="form-control" required="true" aria-required="true" minlength="8" maxlength="50" value="<?php echo $pass; ?>">
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <input type="submit" name="submit" value="Soumettre" class="btn btn-primary mb-3" />
        </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>

<?php include_once("footer.php"); ?>