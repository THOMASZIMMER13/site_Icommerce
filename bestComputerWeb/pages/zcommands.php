<?php
$title = "Liste des commandes";
include_once("head.php");

//récupérer l'id de l'utilisateur actuellement connecté
 if($_SESSION['email'] ){
  $query = "SELECT id, email FROM user WHERE email = '".$_SESSION["email"]."' limit 1";
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);
  $id = $user["id"];
  if (!$user) {
    header("Location: error.php");
  }
 } else {
   header("Location: error.php");
 }


// Vérifie si l'utilisateur est connecté
//session_start();
//if(!isset($_SESSION['user_id'])) {
//  die("Erreur : Utilisateur non connecté.");
//}

//$user_id = $_SESSION['user_id'];

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


// Récupère toutes les commandes de l'utilisateur connecté
$query = "SELECT c.id, c.date, c.status, user.firstname, user.lastname 
          FROM command c 
          LEFT JOIN user ON user.id = c.userId 
          WHERE c.userId = $id 
          ORDER BY status DESC";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
    die("Erreur");
} 
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
      <td> 
          <?php echo "<a href='command-detail.php?id=".$row["id"]."'>Modifier</a>"; ?>
        </td>
        
        
        </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>
</div>
<?php include_once("footer.php"); ?>
