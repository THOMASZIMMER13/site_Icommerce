<?php
session_start();
require('../bd/config.php');
$basket = array();
$erreur = '';
$valid = true;
$product = null;

if (isset($_REQUEST['reset'])){ 
    unset($_SESSION['basket']);
header('Location: basket.php');
    exit();
} 

if (isset($_REQUEST['go']) || isset($_REQUEST['terminate'])){
  $newBasket = array();
  $ids = array($_REQUEST['id']);
  if (isset($_SESSION['basket'])) {
    for ($row = 0; $row < count($_SESSION['basket']); $row++) {
      if ($_REQUEST['id'] != $_SESSION['basket'][$row][0]) {
        array_push($ids, $_SESSION['basket'][$row][0]);
      }
    }
  }


  for($index = 0; $index < count($ids); $index++) {
    $id = $ids[$index];
    if ($_REQUEST[$id] > 0) {
      $query = "SELECT * FROM product WHERE id = ".$id;
      $res = mysqli_query($conn, $query);
      $item = mysqli_fetch_assoc($res);
      if ($item['inventory'] >= $_REQUEST[$id]) {
        array_push($newBasket, array($item['id'], $item['title'], $item['price'], $_REQUEST[$id]));
      } else {
        $valid = false;
        $erreur .= "<p>Le produit ".$item['title'] ." a un stock limité à ". $item['inventory']."</p>";
      }
    }
  }

  if ($valid) {
    $_SESSION['basket'] = $newBasket;
    if (isset($_REQUEST['terminate'])) {
      if (isset($_SESSION['id'])) {
        header('Location: basket-validate.php');
        exit();
      } else {
        $basket = $newBasket;
        $erreur = 'Vous devez être connecté pour passer une commande';
      }
    } else {
      header('Location: index.php');
      exit();
    }
    
  }
  
} else {

  if (isset($_REQUEST["id"])) {
    $query = "SELECT * FROM product WHERE id = ".$_REQUEST["id"];
    // Exécute la requête sur la base de données
    $res = mysqli_query($conn, $query);

    $product = mysqli_fetch_assoc($res);
    if (!isset($product["id"])) {
      header("Location: error.php");
    }
  }
  
  if (isset($_SESSION['basket'])) {
    $found = false;
    for ($index = 0; $index < count($_SESSION['basket']); $index++) {
      if ($_REQUEST['id'] == $_SESSION['basket'][$index][0]) {
        $found = true;
        $_SESSION['basket'][$index][3]++;
      }
    }
    $basket = $_SESSION['basket'];
    if ($found == false && isset($_REQUEST['id'])) {
      array_push($basket, array( $product['id'], $product['title'], $product['price'], 1));
    } 
  } else if (isset($_REQUEST['id'])){
    $basket = array(array( $product['id'], $product['title'], $product['price'], 1) );
  } 
}

?>

<?php 
  $title = 'Votre Panier';
  include ("head.php"); 
?>
<div class="container">
  <div class="row">
    <h2> <?php echo $title; ?></h2>
    <p><?php echo $erreur; ?></p>
    <?php if (count($basket) < 1) {
      echo "<p>Le panier est vide</p>";
    } else {?>
    <form method="post" action="">
      <table role="presentation">
        <thead>
        <tr>
          <th class="">Label</th>
          <th class="">Prix</th>
          <th>Unité</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($row = 0; $row < count($basket); $row++) {?>
          <tr>
            <td> <?php echo $basket[$row][1]; ?></td>
            <td> <?php echo $basket[$row][2]; ?> €</td>
            <td>
              <select name="<?php echo $basket[$row][0]; ?>">
                <?php for ($index = 0; $index <= 5; $index++) {?>
                  <option value="<?php echo $index; ?>" <?php if ($index == $basket[$row][3]) echo 'selected'; ?>> <?php echo $index; ?></option>
                <?php }?>
              </select>
            </td>
        <?php } ?>
      </tbody>
      </table>
      <input type="submit" value="Vider le panier" name="reset">
      <input type="submit" value="Continuer" name="go">
      <input type="submit" value="Valider La Commande" name="terminate">
    </form>
    <?php } ?>
  </div>
</div>

<?php include ("footer.php"); ?>