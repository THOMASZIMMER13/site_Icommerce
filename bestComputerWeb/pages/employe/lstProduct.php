<?php
$title = "Listing des produits.";
include_once("../head.php");
include_once("validateAuth.php");
// require('../../bd/config.php');

// Récupère tous les produits et le nombre dans le stock.
$query = "SELECT id, title, inventory, productType FROM product";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
  die("Erreur");
}
?>

<div class="container">

  <div class="p-4 p-md-4 mb-2">
    <h2><i class="bi bi-box-seam" style="font-size: 3rem;"></i>Liste des Produits</h2>
    <div class="d-grid gap-2 d-md-block">
      <a href="addLaptop.php" class="btn btn-primary"> Ajouter un nouvel ordinateur portable </a>
      <a href="addDesktop.php" class="btn btn-primary"> Ajouter un nouvel ordinateur fixe </a>
      <a href="addAccessory.php" class="btn btn-primary"> Ajouter un nouvel accessoire </a>
    </div>
  </div>

  <div style="padding-bottom:3em">
    <table class="table">
      <thead>
        <tr>
          <th>Catégories</th>
          <th>Modèle</th>
          <th>Stock</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($res)) : ?>
          <tr>
            <td><?php echo htmlspecialchars($row['productType']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['inventory']); ?></td>
            <td>
              <?php
              switch ($row["productType"]) {
                case "desktop":
                  echo "<a href='addDesktop.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
                case "laptop":
                  echo "<a href='addLaptop.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
                case "accessory":
                  echo "<a href='addAccessory.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
              }
              ?>

            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</div>
<?php include_once("../footer.php"); ?>