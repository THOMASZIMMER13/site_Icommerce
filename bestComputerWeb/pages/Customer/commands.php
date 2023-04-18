<?php
include ("validateAuth.php");
require('../../bd/config.php');

function showStatus($status) {
  switch ($status) {
    case 'validated':
      echo 'Validée';
      break;
    case 'deleted':
      echo 'Annulée';
      break;
  }
}

// Récupère les commandes de l'utilisateur actuellement connecté
//$userId = $_SESSION['user']['id'];
$query = "SELECT c.id, c.date, c.status, u.firstname, u.lastname FROM command c JOIN user u ON c.userId = u.id WHERE u.id = {$_SESSION['id']} ORDER BY c.date DESC";


// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
    die("Erreur");
}

?>
<?php 
$title = "Listing des Commandes.";
include("../head.php"); 
?>
<div class="container">
<div class="row">
<h2>Liste des Commandes</h2>
<table>
  <thead>
    <tr>
      <th>Numéro</th> 
      <th>Date</th>
      <th>Client</th> 
      <th>Statut</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($res)) : ?>
    <tr>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['date']); ?></td>
      <td><?php echo htmlspecialchars($row['firstname']) ." " . htmlspecialchars($row['lastname']); ?></td>
      <td><?php echo showStatus($row['status']); ?></td>
      <td><?php echo showStatus($row['status']); ?></td>
      <td> 
          <?php echo "<a href='../command-detail.php?id=".$row["id"]."'>Modifier</a>"; ?>
        </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>
</div>
<?php include("../footer.php"); ?>
