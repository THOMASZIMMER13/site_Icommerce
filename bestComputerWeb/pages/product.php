<?php
$title = "Tout nos produits";
include_once("head.php");

$res = null;
$erreur = '';
$clause = '';
if (isset($_REQUEST["txt"])) {
  $clause = "WHERE title LIKE '%" . $_REQUEST["txt"] . "%'";
}

$query = "SELECT id, title, brand, model, price, description, img FROM product $clause";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
  $erreur = 'Erreur au moment de la recherche';
}

echo $erreur; ?>

<div class="container">

  <div class="p-4 p-md-4 mb-2">
    <h2>Nos produits</h2>
    <p><?php echo (!empty($res) && ($res->num_rows > 0))  ? $res->num_rows. " produits " : 0 . " produit "; ?></p>
  </div>

  <div class="row row-cols-1 row-cols-md-4 g-4" style="padding-bottom: 3em">
    <?php while ($row = mysqli_fetch_assoc($res)) : ?>
      <div class="col">
        <div class="card">
          <img src="../<?php echo $row["img"]; ?>" class="card-img-top img-fluid" style="max-height:150px;max-width:200px;margin:auto;" alt="...">
          <div class="card-body" style="margin:auto;">
            <h5 class="card-title"> <?php echo $row["title"]; ?> </h5>
            <ul>
              <li>Modèle: <?php echo $row["model"]; ?></li>
              <li>Marque: <?php echo $row["brand"]; ?></li>
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
<?php include_once("footer.php"); ?>