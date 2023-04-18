<?php
session_start();
require('../bd/config.php');
$basket = array();
$erreur = '';
$valid = true;

if (isset($_REQUEST['terminate'])) {
  //command
  $query = "INSERT INTO command (date, status, userId) VALUES (CURRENT_DATE(), 'validated', ".$_SESSION['id'].")";
  $res = mysqli_query($conn, $query);
  //product_command
  $query = "SELECT LAST_INSERT_ID() AS id";
  $res = mysqli_query($conn, $query);
  $command = mysqli_fetch_assoc($res);
  for ($row = 0; $row < count($_SESSION['basket']); $row++) {
    try {
      $query = "INSERT INTO product_command (commandId, productId, quantity) VALUES (".$command['id'].", ".$_SESSION['basket'][$row][0].", ".$_SESSION['basket'][$row][3].")";
      $res = mysqli_query($conn, $query);
      $_SESSION['basket'] = null;
  header('Location: validation.php?case=command');
  exit();
    } catch (Exception $err) {

    //$erreur = $err;
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

<?php 
  $title = 'Validation Du Panier';
  include ("head.php"); 
?>
<div class="container">
  <div class="row">
    <h2> <?php echo $title; ?></h2>
    <p><?php echo $erreur; ?></p>
    <form method="post" action="">
      <table role="presentation">
        <thead>
        <tr>
          <th class="">Label</th>
          <th>Unité</th>
          <th class="">Prix</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($row = 0; $row < count($basket); $row++) {?>
          <tr>
            <td> <?php echo $basket[$row][1]; ?></td>
            <td> <?php echo $basket[$row][3]; ?></td>
            <td> <?php echo $basket[$row][2] * $basket[$row][3]; ?> €</td>  
        <?php } ?>
      </tbody>
      </table>
      <input type="submit" value="Retour" name="go">
      <input type="submit" value="Passer Commande" name="terminate">
    </form>
  </div>
</div>

<?php include ("footer.php"); ?>