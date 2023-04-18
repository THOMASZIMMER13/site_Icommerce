<?php
session_start();
require('../bd/config.php');
$basket = array();
$erreur = '';
$valid = true;

if (isset($_REQUEST['terminate'])) {
  header("Location: commands.php");
} else if (isset($_REQUEST['go'])) {
  $query = "UPDATE command SET status = 'deleted' WHERE id = ".$_REQUEST['id'];
  $res = mysqli_query($conn, $query);
  header("Location: commands.php");
  exit();
} else {

  if (isset($_REQUEST['id'])) {
    $query = "SELECT p.id, p.title, p.price, c.quantity FROM product_command c LEFT JOIN product p ON p.id = c.productId WHERE c.commandId = ".$_REQUEST['id'];
    $res = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res)) {
      array_push($basket, array($row['id'], $row['title'], $row['price'], $row['quantity']));
    }
  } else {
    header('Location: error.php');
  }
}

?>

<?php 
  $title = 'Revue Commande';
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
      <input type="submit" value="Annuler" name="go">
      <input type="submit" value="Ok" name="terminate">
    </form>
  </div>
</div>

<?php include ("footer.php"); ?>