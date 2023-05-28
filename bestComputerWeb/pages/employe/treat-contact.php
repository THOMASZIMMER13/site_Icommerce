<?php
$title = "Message reçu via le formulaire";
include_once("../head.php");
include_once("validateAuth.php");

$erreur = '';
$id = 0;
$firstname = '';
$lastname = '';
$email = '';
$subject = '';
$message = '';
$status = '';
$comment  = '';

// Traitement du formulaire
if (isset($_POST['submit'])) {
  $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));
  $comment = mysqli_real_escape_string($conn, stripslashes($_REQUEST['comment']));
  $status = mysqli_real_escape_string($conn, stripslashes($_REQUEST['status']));

  // Préparation et exécution de la requête d'insertion
  $query = "UPDATE contact SET comment = '$comment', status = '$status' WHERE id = $id";
  // Exécute la requête sur la base de données
  try {
    $res = mysqli_query($conn, $query);
    if ($res) {
      header('Location: ConsultMsg.php');
    }
  } catch (Exception $err) {
    $erreur = "Une erreur s'est produite vueillez revenir plus tard sur cette page";
    $erreur = $err;
  }
} else {
  if (isset($_REQUEST["id"])) {
    $query = "SELECT id, firstname, lastname, email, message, comment, subject, status FROM contact WHERE id = " . $_REQUEST["id"];
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);
    if ($data) {
      $id = $data["id"];
      $firstname = $data["firstname"];
      $lastname = $data["lastname"];
      $email = $data["email"];
      $subject = $data["subject"];
      $message = $data["message"];
      $status = $data["status"];
      $comment = $data["comment"];
    }
  }
}

function isSelected($status, $value) {
  if ($status == $value) {
    echo 'selected';
  } else {
    echo '';
  }
}
?>
<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8" style="padding-bottom: 3em">
    <div class="p-4 p-md-4 mb-2">
      <h1> Message reçu via le formulaire </h1>
      <?php if (!empty($erreur)) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-circle-fill" style="margin-right:10px"></i>
          <?php echo $erreur; ?>
        </div>
      <?php } elseif (!empty($erreur)) { ?>
        <div class="alert alert-success" role="alert">
          <i class="bi bi-check-lg"></i>
          <?php echo $result; ?>
        </div>
      <?php } ?>
      </div>
      <div class="p-2 p-md-2 mb-2">
      <div class="card">
        <div class="card-header">
          Message n° <?php echo $id; ?>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Client : <?php echo strtoupper($lastname) . ' ' . ucfirst($firstname); ?></li>
          <li class="list-group-item">Email : <?php echo $email; ?></li>
          <li class="list-group-item">Objet : <?php echo $subject; ?></li>
          <li class="list-group-item">Message : <?php echo $message; ?></li>
        </ul>
      </div>
      </div>
      <form action="" method="post" class="grid">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-4 row">
          <label for="comment" class="col-sm-4 col-form-label">Commentaire :</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" id="comment" name="comment" value="<?php echo $comment; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="status" class="col-sm-4 col-form-label">Statut :</label>
          <div class="col-sm-8">
            <select name="status" class="form-select">
              <option value="to_treat" <?php isSelected($status, 'to_treat'); ?>> A traiter </option>
              <option value="treated" <?php isSelected($status, 'treated'); ?>> Archiver </option>
            </select>
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <input type="submit" name="submit" placeholder="Envoyer " class="btn btn-sm btn-success" />
        </div>
      </form>
    </div>
  </div>
  <?php include_once("../footer.php"); ?>