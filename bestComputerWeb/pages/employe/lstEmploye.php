<?php
$title = "Listing des employés de l'entreprise.";
include_once("../head.php");
include_once("validateAuth.php");
// require_once('../../bd/config.php');


//récupère tous les employés de l'entreprise
$query = "SELECT id, role, male, email, lastname, firstname, pass FROM user where role='employe'";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
  die("Erreur");
}
?>

<div class="container">
  <div class="p-4 p-md-4 mb-2">
    <h2><i class="bi bi-people-fill" style="font-size: 3rem;"></i>Liste des employés de l'entreprise</h2>
    <div class="d-grid gap-2 d-md-block">
      <a href="addemploye.php" class="btn btn-primary"> Ajouter un nouvel employé </a>
    </div>
  </div>
  <div style="padding-bottom:3em">
    <table class="table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($res)) : ?>
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

<?php include_once("../footer.php"); ?>