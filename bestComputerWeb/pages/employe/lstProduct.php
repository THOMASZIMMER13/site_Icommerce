<?php
$title = "Listing des produits.";
include_once("../head.php");
include_once("validateAuth.php");

// Récupère tous les produits et le nombre dans le stock.
$query = "SELECT id, title, inventory, productType FROM product WHERE inventory>0";

//récupère les produits en ruptures de stock
$stock = "SELECT id, title, inventory, productType FROM product WHERE inventory<=0";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);
$rest = mysqli_query($conn, $stock);

// Vérifie si la requête a échoué
if ($res === false) {
  die("Erreur lors de l'affichage des produits");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Vérifie si le formulaire de suppression a été soumis
  if (isset($_POST["delete"])) {
    $id = $_POST["delete"];
    $deleteQuery = "DELETE FROM product WHERE id='$id'";

    try {
      $deleteResult = mysqli_query($conn, $deleteQuery);

      if ($deleteResult === false) {
        die("Erreur lors de la suppression du produit");
      }

      // Redirige vers la page actuelle pour actualiser la liste des produits
      header("Location: $_SERVER[PHP_SELF]");
      exit();
    } catch (Exception $err) {
      $err = $erreur;
    }
  }
}
?>

<div class="container">
<div style="padding-bottom:3em">
    <h2><i class="bi bi-box-seam" style="font-size: 3rem;"></i>Inventaire des articles </h2>
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Ajouter un nouveau produit
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="addLaptop.php"> Ordinateurs portables </a></li>
      <li><a class="dropdown-item" href="addDesktop.php"> Ordinateurs de bureau </a></li>
      <li><a class="dropdown-item" href="addAccessory.php"> Accessoire </a></li>
    </ul>
    </div>

  <div style="padding-bottom:3em">
    <h2><i class="bi bi-box2-fill" style="font-size: 3rem;"></i>Inventaire des articles actuellement indisponibles </h2>
    <table class="table">
      <thead>
        <tr>
          <th>Catégories</th>
          <th>Modèle</th>
          <th>Stock</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($rest)) : ?>
          <tr>
            <td><?php echo htmlspecialchars($row['productType']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['inventory']); ?></td>
            <td>
              <?php
              switch ($row["productType"]) {
                case "desktop":
                  echo "<a class='btn btn-sm btn-warning' href='addDesktop.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
                case "laptop":
                  echo "<a class='btn btn-sm btn-warning' href='addLaptop.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
                case "accessory":
                  echo "<a class='btn btn-sm btn-warning' href='addAccessory.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
              }
              ?>
            </td>
            <td>
              <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <div style="padding-bottom:3em">
    <h2><i class="bi bi-box2" style="font-size: 3rem;"></i>Liste des Produits actuellement en stock</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Catégories</th>
          <th>Modèle</th>
          <th>Stock</th>
          <th>Actions</th>
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
                  echo "<a class='btn btn-sm btn-warning' href='addDesktop.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
                case "laptop":
                  echo "<a class='btn btn-sm btn-warning' href='addLaptop.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
                case "accessory":
                  echo "<a class='btn btn-sm btn-warning' href='addAccessory.php?id=" . $row["id"] . "'>Modifier</a>";
                  break;
              }
              ?>

            </td>
            <td>
              <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</div>
<?php include_once("../footer.php"); ?>