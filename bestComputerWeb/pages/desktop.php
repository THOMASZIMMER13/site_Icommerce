<?php
$title = "Ordinateurs de bureau";
include_once("head.php");

// session_start();
// require('../bd/config.php');
$res = null;
$erreur = '';
$clause = '';
if (isset($_REQUEST["txt"])) {
  $clause = "WHERE title LIKE '%" . $_REQUEST["txt"] . "%'";
}

$query = "SELECT id, productType, inventory, model, brand, title, description, price, serialnumber, releaseDate, processor, ram, storage, os, computFormat, img FROM product $clause where productType='desktop'";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
  $erreur = 'erreur au moment de la recherche';
}
echo $erreur; ?>

<div class="container">
  <div class="p-4 p-md-4 mb-2">
    <h2>Liste des Pc fixes</h2>
    <p><?php echo (!empty($res) && ($res->num_rows > 0))  ? $res->num_rows . " produits " : 0 . " produit "; ?></p>
  </div>
  <div class="row row-cols-1 row-cols-md-4 g-4" style="padding-bottom: 3em">
    <?php while ($row = mysqli_fetch_assoc($res)) : ?>
      <div class="col">
        <div class="card">
          <img src="../<?php echo $row["img"]; ?>" class="card-img-top img-fluid" style="max-height:150px;max-width:200px;margin:auto;" alt="...">
          <div class="card-body" style="margin:auto;">
            <h5 class="card-title"> <?php echo $row["title"]; ?> </h5>
            <ul>
                <li>Processeur: <?php echo $row["processor"]; ?></li>
                <li>RAM: <?php echo $row["ram"] . " GO "; ?></li>
                <li>Stockage: <?php echo $row["storage"] . " GO "; ?></li>
                <li>Système d'exploitation: <?php echo $row["os"]; ?></li>
                <li>Format: <?php echo $row["computFormat"]; ?></li>
                <li>Pièce actuellement disponible: <?php echo $row["inventory"]; ?></li>
                <li>Prix: <?php echo $row["price"] . " €"; ?></li>
            </ul>
            <a class="btn btn-sm btn-outline-dark" role="button" href="product-detail.php?id=<?php echo $row["id"]; ?>" class="card-link"> Détail </a>
            <a class="btn btn-sm btn-primary" role="button" href="basket.php?id=<?php echo $row["id"]; ?>"> Ajouter au panier</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include("footer.php"); ?>