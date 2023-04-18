<?php
session_start();
require('../bd/config.php');
$res = null;
$erreur = '';
$clause = '';
if (isset($_REQUEST["txt"])) {
  $clause = "WHERE title LIKE '%".$_REQUEST["txt"]."%'";
}

$query = "SELECT * FROM product $clause where productType='desktop'";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
    $erreur = 'erreur au moment de la recherche';
}

?>

<?php 
  $title = "Ordinateurs de bureau";
  include ("head.php"); 
?>
<?php echo $erreur; ?>

<div class="container">
  <div class="row">
  <h2>Liste des Pc fixes</h2>
     </p>
    <?php while($row = mysqli_fetch_assoc($res)) : ?>
      <div class="row p-3">
        <div class="card-body">
          <h5 class="card-title"> <?php echo $row["title"]; ?> </h5>
          <p class="card-text">Processeur: <?php echo $row["processor"]; ?> </p>
          <p class="card-text">RAM: <?php echo $row["ram"] . " GO "; ?> </p>
          <p class="card-text">Stockage: <?php echo $row["storage"] . " GO "; ?> </p>
          <p class="card-text">Système d'exploitation: <?php echo $row["os"]; ?> </p>
          <p class="card-text">Format: <?php echo $row["computFormat"]; ?> </p>
          <p class="card-text">Prix: <?php echo $row["price"] . " €"; ?> </p>
          <a href="product-detail.php?id=<?php echo $row["id"]; ?>" class="card-link"> Détail </a>
          <a href="basket.php?id=<?php echo $row["id"]; ?>" > Ajouter Au Panier</a>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include ("footer.php"); ?>