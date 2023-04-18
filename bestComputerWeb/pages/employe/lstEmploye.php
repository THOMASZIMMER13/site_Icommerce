<?php
include ("validateAuth.php");
require('../../bd/config.php');

//récupère tous les employés de l'entreprise
$query = "SELECT * FROM user where role='employe'";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
    die("Erreur");
}

?>

<?php 
$title = "Listing des employés de l'entreprise.";
include("../head.php"); 
?>

<div class="container">
<div class="row">
<div>
<h2> Ajouter un nouvel employé </h2>
<a href="addemploye.php"> Cliquez ici pour ajouter un nouvel employé </a>
</div>
<div>

<h2> Liste des employé de l'entreprise </h2>


<table>
  <thead>
    <tr>
      <th>Nom</th> 
      <th>Prénom</th>
      <th>Adresse email</th>
      <th>Actions</th>
	</tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($res)) : ?>
    <tr>
      <td><?php echo htmlspecialchars($row['lastname']); ?></td>
      <td><?php echo htmlspecialchars($row['firstname']); ?></td>
      <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td> <a href="">Supprimer</a> </td>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</div>
</div>
</div>

<?php include("../footer.php"); ?>
