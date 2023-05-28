<?php
$title = 'Modifier ma commande';
include_once("head.php");

$basket = array();
$erreur = '';
$valid = true;

if (isset($_REQUEST['terminate'])) {
  if(!empty($_SESSION) && $_SESSION['role'] == "employe") {
    header("Location: ./employe/commands.php");
  } elseif(!empty($_SESSION) && $_SESSION['role'] == "client") {
    header("Location: ./customer/commands.php");
  } else {
    echo "ERREUR !";
  }
} else if (isset($_REQUEST['go'])) {
  $query = "UPDATE command SET status = 'deleted' WHERE id = " . $_REQUEST['id'];
  $res = mysqli_query($conn, $query);
  if(!empty($_SESSION) && $_SESSION['role'] == "employe") {
    header("Location: ./employe/commands.php");
  } elseif(!empty($_SESSION) && $_SESSION['role'] == "client") {
    header("Location: ./customer/commands.php");
  } else {
    echo "ERREUR !";
  }
  exit();
} else {
  if (isset($_REQUEST['id'])) {
    $query = "SELECT p.id, p.title, p.price, c.quantity FROM product_command c LEFT JOIN product p ON p.id = c.productId WHERE c.commandId = " . $_REQUEST['id'];
    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
      array_push($basket, array($row['id'], $row['title'], $row['price'], $row['quantity']));
    }
  } else {
    header('Location: error.php');
  }
}
?>
<div class="container">
  <div class="p-4 p-md-4 mb-2">
    <h2><i class="bi bi-cart"></i> <?php echo $title; ?></h2>
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
        <input type="submit" value="Annuler" name="go" class="btn btn-sm btn-outline-danger ">
        <input type="submit" value="Ok" name="terminate" class="btn btn-sm btn-success">
      </div>
    </form>
  </div>
</div>

<?php include("footer.php"); ?>