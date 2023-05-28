<?php
$title = 'Validation Du Panier';
include_once("head.php");

$basket = array();
$erreur = '';
$valid = true;

if (isset($_REQUEST['terminate'])) {
  //command
  $query = "INSERT INTO command (date, status, userId) VALUES (CURRENT_DATE(), 'validated', " . $_SESSION['id'] . ")";
  $res = mysqli_query($conn, $query);
  //product_command
  $query = "SELECT LAST_INSERT_ID() AS id";
  $res = mysqli_query($conn, $query);
  $command = mysqli_fetch_assoc($res);
  for ($row = 0; $row < count($_SESSION['basket']); $row++) {
    try {
      $query = "INSERT INTO product_command (commandId, productId, quantity) VALUES (" . $command['id'] . ", " . $_SESSION['basket'][$row][0] . ", " . $_SESSION['basket'][$row][3] . ")";
      $res = mysqli_query($conn, $query);
      $_SESSION['basket'] = null;
      header('Location: validation.php?case=command');
      exit();
    } catch (Exception $err) {
      $erreur = 'erreur lors de la tentative de commande';
    }
  }
} else if (isset($_REQUEST['go'])) {
  header('Location: basket.php');
  exit();
} else {

  if (isset($_SESSION['basket'])) {
    $basket = $_SESSION['basket'];
  } else {
    header('Location: error.php');
  }
}

?>
<div class="container">
  <div class="p-4 p-md-4 mb-2">
    <h2><i class="bi bi-cart-check"></i> <?php echo $title; ?></h2>
      <?php if (!empty($erreur)) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-circle-fill"></i>
          <?php echo $erreur; ?>
        </div>
      <?php } ?>
      <form method="post" action="">
        <table role="presentation" class="table">
          <thead>
            <tr>
              <th class="">Désignation</th>
              <th>Quantité</th>
              <th class="">Prix total ttc</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($row = 0; $row < count($basket); $row++) { ?>
              <tr>
                <td> <?php echo $basket[$row][1]; ?></td>
                <td> <?php echo $basket[$row][3]; ?></td>
                <td> <?php echo $basket[$row][2] * $basket[$row][3]; ?> €</td>
              <?php } ?>
          </tbody>
        </table>
        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
          <input type="submit" value="Retour" name="go" class="btn btn-sm btn-outline-danger ">
          <input type="submit" value="Passer Commande" name="terminate" class="btn btn-sm btn-success"> 
        </div>
      </form>
  </div>
</div>

<?php include("footer.php"); ?>