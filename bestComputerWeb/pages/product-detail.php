<?php
$title = $product['title'];
include_once("head.php");

if (!isset($_REQUEST["id"])) {
  header("Location: error.php");
}
$query = "SELECT id, title, description, price, model, brand, img, productType, ram, os, processor, storage, screenSize, computFormat  FROM product WHERE id = " . $_REQUEST["id"];
// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

$product = mysqli_fetch_assoc($res);
if (!isset($product["id"])) {
  header("Location: error.php");
}
$description = $product['description'];
$price = $product['price'];
?>

<div class="container p-4 p-md-5 mb-4">
  <div class="row justify-content-center">
    <div class="col-3">
      <img src="../<?php echo $product["img"]; ?>" class="float-start" style="max-height:200px;max-width:300px;" alt="...">
    </div>
    <div class="col align-middle" style="margin:auto;">
      <h1><?php echo $product["title"]; ?></h1>
      <h3><?php echo $product["price"]; ?>€</h3>
      <a class="btn btn-sm btn-primary" role="button" href="basket.php?id=<?php echo $product["id"]; ?>"> Ajouter au panier</a>
    </div>
  </div>
</div>
<div class="container">
  <div class="accordion" id="accordionExample" style="padding-bottom:3em">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Description du produit
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <p class="text-wrap"><?php echo $description; ?></p>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          Caractéristiques techniques
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <ul>
            <?php switch ($product["productType"]) {
              case "laptop": ?>
                <li>Processeur: <?php echo $product["processor"]; ?></li>
                <li>RAM: <?php echo $product["ram"] . " GO "; ?></li>
                <li>Stockage: <?php echo $product["storage"] . " GO "; ?></li>
                <li>Système d'exploitation: <?php echo $product["os"]; ?></li>
                <li>Taille d'écran: <?php echo $product["screenSize"] . " Pouces "; ?></li>
              <?php break;
              case "desktop": ?>
                <li>Processeur: <?php echo $product["processor"]; ?></li>
                <li>RAM: <?php echo $product["ram"] . " GO "; ?></li>
                <li>Stockage: <?php echo $product["storage"] . " GO "; ?></li>
                <li>Système d'exploitation: <?php echo $product["os"]; ?></li>
                <li>Format: <?php echo $product["computFormat"]; ?></li>
              <?php break;
              default: ?>
                <li>Modèle: <?php echo $product["model"]; ?></li>
                <li>Marque: <?php echo $product["brand"]; ?></li>
            <?php break;
            } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once("footer.php"); ?>