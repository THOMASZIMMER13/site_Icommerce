<?php
session_start();
require('../bd/config.php');
if (!isset($_REQUEST["id"])) {
  header("Location: error.php");
}
$query = "SELECT * FROM product WHERE id = ".$_REQUEST["id"];
// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

$product = mysqli_fetch_assoc($res);
if (!isset($product["id"])) {
  header("Location: error.php");
}

?>

<?php 
  $title = $product['title'];
  $description = $product['description'];
  $price = $product['price'];
  include ("head.php"); 
?>
<div class="container">
  <div class="row">
  <h2> <?php echo $title; ?></h2>
  <?php echo $price . " €"; ?>
  <a href="basket.php?id=<?php echo $product["id"]; ?>" > Ajouter Au Panier</a>
</p>
<h2> Description du produit </h2>
</p>
  <?php echo $description; ?>
  </div>
</div>
<?php include ("footer.php"); ?>