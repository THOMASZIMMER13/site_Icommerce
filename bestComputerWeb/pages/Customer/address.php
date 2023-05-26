<?php
$title = "Mes informations postales";
include_once("../head.php");

$result = '';
$address = "";
$complement = "";
$cp = "";
$town = "";
$phone = "";
$description = "";
$erreur = "";
$valid = true;
$user = null;
$id = 0;

//récupérer l'id de l'utilisateur actuellement connecté
if ($_SESSION['id'] && $_SESSION['id'] !== 0) {
  $query = "SELECT id, role, male, lastname, firstname, email, pass FROM user WHERE id = " . $_SESSION['id'];
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);

  if (!$user) {
    header("Location: ../error.php");
  }

  $query = "SELECT id, address, complement, cp, town, phone, description FROM address WHERE userid = " . $user['id'];

  $res = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($res);

  if ($data) {
    $id = $data["id"];
    $address = $data["address"];
    $complement = $data["complement"];
    $cp = $data["cp"];
    $town = $data["town"];
    $phone = $data["phone"];
    $description = $data["description"];
  }
} else {
  header("Location: ../error.php");
}

if (isset($_REQUEST['id'], $_REQUEST['address'], $_REQUEST['complement'], $_REQUEST['cp'], $_REQUEST['town'], $_REQUEST['phone'], $_REQUEST['description'])) {
  // Réinitialisation des variables d'alerte (messages d'informations)
  $result = '';
  $erreur = "";
  $valid = true;

  /* 
    * Récupération des données
    * ID
    * ADDRESS
    * COMPLEMENT
    * POSTALCODE
    * TOWN
    * PHONE
    * DESCRIPTION
    */
  $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));
  $address = mysqli_real_escape_string($conn, stripslashes($_REQUEST['address']));
  $complement = mysqli_real_escape_string($conn, stripslashes($_REQUEST['complement']));
  $cp = mysqli_real_escape_string($conn, stripslashes($_REQUEST['cp']));
  $town = mysqli_real_escape_string($conn, stripslashes($_REQUEST['town']));
  $phone = mysqli_real_escape_string($conn, stripslashes($_REQUEST['phone']));
  $description = mysqli_real_escape_string($conn, stripslashes($_REQUEST['description']));

  // $id_session = $_SESSION["id"];
  //$id =$user['id'];
  //Enregistrement Adresse SQL
  if ($user['id'] > 0) {
    $query = "SELECT id, address, complement, cp, town, phone, description FROM address WHERE userid = " . $user['id'];
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);

    if (empty($data)) {
      $query_d = "INSERT INTO address (address,complement,cp,town,phone,description, userid)
              VALUES ('" . $address . "','" . $complement . "','" . $cp . "','" . $town . "','" . $phone . "','" . $description . "','" . $user['id'] . "')";
    } else {
      $query_d = "UPDATE address SET address='" . $address . "',complement='" . $complement . "',cp='" . $cp . "', town='" . $town . "',phone='" . $phone . "', description='" . $description . "' WHERE userid = " . $user['id'];
    }

    // Exécute la requête sur la base de données
    try {
      $res = mysqli_query($conn, $query_d);
      $result = $res;
      if ($res) {
        $result = 'Modification de vos informations effectuée.';
      }
    } catch (Exception $err) {
      var_dump($err);
    }
  } else {
    $erreur = "Une erreur est survenue, merci de re-tenter l'opération. Si le problème persiste contactez-nous!";
  }
}
?>

<div class="container">
  <!-- <div class="p-6 p-md-5 mb-6"> -->
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
      <div class="p-4 p-md-4 mb-2">
        <h2><i class="bi bi-house-add-fill" style="font-size: 3rem;"></i>Mon adresse</h2>
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
        <form class="box" action="" method="post">

          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="mb-4 row">
            <label for="address" class="col-sm-2 col-form-label">N° & voie *:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="address" name="address" required="true" aria-required="true" minlength="2" maxlength="40" value="<?php echo $address; ?>">
            </div>
          </div>
          <div class="mb-4 row">
            <label for="complement" class="col-sm-2 col-form-label">Complément :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="complement" name="complement" aria-required="true" minlength="2" maxlength="30" value="<?php echo $complement; ?>">
            </div>
          </div>
          <div class="mb-4 row">
            <label for="cp" class="col-sm-2 col-form-label">Code postal *:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="cp" name="cp" required="true" aria-required="true" placeholder="69000" maxlength="5" value="<?php echo $cp; ?>">
            </div>
          </div>
          <div class="mb-4 row">
            <label for="town" class="col-sm-2 col-form-label">Ville *:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="town" name="town" required="true" aria-required="true" maxlength="30" value="<?php echo $town; ?>">
            </div>
          </div>
          <div class="mb-4 row">
            <label for="phone" class="col-sm-2 col-form-label">Téléphone *:</label>
            <div class="col-sm-8">
              <input type="tel" class="form-control" id="phone" name="phone" required="true" aria-required="true" maxlength="10" value="<?php echo $phone; ?>">
            </div>
          </div>
          <div class="mb-4 row">
            <label for="description" class="col-sm-2 col-form-label">Compléments :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="description" name="description" aria-required="true" maxlength="250" value="<?php echo $description; ?>">
            </div>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" name="submit" value="Soumettre" class="btn btn-primary mb-3" />
          </div>
        </form>
      </div>
      <div class="col-2"></div>
    <!-- </div> -->
  </div>
</div>

<?php include("../footer.php"); ?>