<?php
require('../../bd/config.php');
include("validateAuth.php");
//récupère tous les msg
$query = "SELECT * FROM contact ORDER BY status";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
    die("Erreur");
}

function showStatus($status) {
  switch($status) {
    case 'to_treat':
      echo 'A traiter';
      break;
    case 'treated':
      echo 'Archivé';
      break;
    default:
      echo '';
  }
}

?>

<?php 
$title = "Message reçu via le formulaire";
include("../head.php"); 
?>

<div class="container">
<div class="row">
<div>
<h2> Messages </h2>

</div>
<div>




<table>
  <thead>
    <tr>
      <th>Nom</th> 
      <th>Prénom</th>
      <th>Adresse email</th>
      <th>Sujet </th>
      <th>Statut </th>
      <th>Action</th>
	</tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($res)) : ?>
    <tr>
      <td><?php echo htmlspecialchars($row['lastname']); ?></td>
      <td><?php echo htmlspecialchars($row['firstname']); ?></td>
      <td><?php echo htmlspecialchars($row['email']); ?></td>
      <td><?php echo htmlspecialchars($row['sujet']); ?></td>
      <td><?php echo showStatus($row['status']); ?></td>
      <td><a href='treat-contact.php?id=<?php echo $row["id"] ?>'>Modifier</a> </td>
      
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>
</div>
</div>

<?php include("../footer.php"); ?>
