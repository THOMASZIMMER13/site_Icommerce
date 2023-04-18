<?php
include ("validateAuth.php");
require('../../bd/config.php');

// Récupère tous les produits et le nombre dans le stock.
$query = "SELECT id, title, inventory, productType FROM product";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
    die("Erreur");
}

?>

<?php 
$title = "Listing des produits.";
include("../head.php"); 
?>
<div class="container">
<div class="row">
<div>
  <h2> Ajouter un nouveau produit </h2>
<ul>
<li><a href="addLaptop.php"> Ajouter un nouvel ordinateur portable </a>
<li><a href="addDesktop.php">Ajouter un nouvel ordinateur fixe </a>
<li><a href="addAccessory.php">Ajouter un nouvel accessoire </a>
</ul>
</div>
<div>
<h2>Liste des Produits</h2>
<table>
  <thead>
    <tr>
      <th>Catégories</th> 
      <th>Modèle</th> 
      <th>Stock</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($res)) : ?>
    <tr>
      <td><?php echo htmlspecialchars($row['productType']); ?></td>
      <td><?php echo htmlspecialchars($row['title']); ?></td>
      <td><?php echo htmlspecialchars($row['inventory']); ?></td>
      <td> 
          <?php 
            switch($row["productType"]) {
              case "desktop":
                echo "<a href='addDesktop.php?id=".$row["id"]."'>Modifier</a>";
                break;
              case "laptop":
                echo "<a href='addLaptop.php?id=".$row["id"]."'>Modifier</a>";
                break;
              case "accessory":
                echo "<a href='addAccessory.php?id=".$row["id"]."'>Modifier</a>";
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
</div>
<?php include("../footer.php"); ?>
