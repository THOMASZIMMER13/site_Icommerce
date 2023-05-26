<?php
$title = 'Votre Panier';
include_once("head.php");

$basket = array();
$erreur = '';
$valid = true;
$product = null;

if (isset($_REQUEST['reset'])) {
  unset($_SESSION['basket']);
  header('Location: basket.php');
  exit();
}

if (isset($_REQUEST['go']) || isset($_REQUEST['terminate'])) {
  $newBasket = array();
  $ids = array($_REQUEST['id']);
  if (isset($_SESSION['basket'])) {
    for ($row = 0; $row < count($_SESSION['basket']); $row++) {
      if ($_REQUEST['id'] != $_SESSION['basket'][$row][0]) {
        array_push($ids, $_SESSION['basket'][$row][0]);
      }
    }
  }


  for ($index = 0; $index < count($ids); $index++) {
    $id = $ids[$index];
    if ($_REQUEST[$id] > 0) {
      $query = "SELECT id, productType, inventory, model, brand, title, description, price, serialnumber, releaseDate, processor, ram, storage, os, screenSize, computFormat FROM product WHERE id = " . $id;
      $res = mysqli_query($conn, $query);
      $item = mysqli_fetch_assoc($res);
      if ($item['inventory'] >= $_REQUEST[$id]) {
        array_push($newBasket, array($item['id'], $item['title'], $item['price'], $_REQUEST[$id]));
      } else {
        $valid = false;
        $erreur .= "<p>Le produit " . $item['title'] . " a un stock limité à " . $item['inventory'] . "</p>";
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
      header('Location: product.php');
      exit();
    }
  }
} else {

  if (isset($_REQUEST["id"])) {
    $query = "SELECT id, productType, inventory, model, brand, title, description, price, serialnumber, releaseDate, processor, ram, storage, os, screenSize, computFormat FROM product WHERE id = " . $_REQUEST["id"];

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
      array_push($basket, array($product['id'], $product['title'], $product['price'], 1));
    }
  } else if (isset($_REQUEST['id'])) {
    $basket = array(array($product['id'], $product['title'], $product['price'], 1));
  }
}  ?>
<div class="container">
  <div class="p-4 p-md-5 mb-4">
    <h2> <?php echo $title; ?></h2>
    <?php if (!empty($erreur)) { ?>
      <div class="alert alert-danger" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i>
        <?php echo $erreur; ?>
      </div>
    <?php } elseif (count($basket) < 1) { ?>
      <div class="alert alert-warning" role="alert">
        <i class="bi bi-info-circle"></i>
        Le panier est vide
      </div>
    <?php } else { ?>
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
                <td>
                  <select name="<?php echo $basket[$row][0]; ?>" class="form-select form-select-sm">
                    <?php for ($index = 0; $index <= 5; $index++) { ?>
                      <option value="<?php echo $index; ?>" <?php if ($index == $basket[$row][3]) echo 'selected'; ?>> <?php echo $index; ?></option>
                    <?php } ?>
                  </select>
                </td>
                <td> <?php echo $basket[$row][2]; ?> €</td>
              <?php } ?>
          </tbody>
        </table>
        <div class="row">
          <div class="col-7"><input type="submit" value="Vider le panier" name="reset" class="btn btn-sm btn-outline-danger"></div>
          <div class="col">
            <input type="submit" value="Continuer" name="go" class="btn btn-sm btn-info">
            <input type="submit" value="Valider ma commande" name="terminate" class="btn btn-sm btn-success">
          </div>
        </div>
      </form>
    <?php } ?>
  </div>
</div>

<?php include_once("footer.php"); ?>