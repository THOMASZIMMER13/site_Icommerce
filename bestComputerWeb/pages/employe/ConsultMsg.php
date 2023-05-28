<?php
$title = "Message reçu via le formulaire";
include_once("../head.php");
include_once("validateAuth.php");


//récupère tous les msg
$query = "SELECT id, email, lastname, firstname, subject, status FROM contact ORDER BY status";

// Exécute la requête sur la base de données
$res = mysqli_query($conn, $query);

// Vérifie si la requête a échoué
if ($res === false) {
  die("Erreur");
}

function showStatus($status)
{
  switch ($status) {
    case 'to_treat':
      echo 'À traiter';
      break;
    case 'treated':
      echo 'Archivé';
      break;
    default:
      echo '-';
  }
}
?>

<div class="container">
  <div class="p-4 p-md-4 mb-2">
    <h2><i class="bi bi-chat-left-text" style="font-size: 3rem;"></i>Liste des messages</h2>
  </div>
  <div style="padding-bottom:3em">
    <table class="table">
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
        <?php while ($row = mysqli_fetch_assoc($res)) : ?>
          <tr>
            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['subject']); ?></td>
            <td><?php echo showStatus($row['status']); ?></td>
            <td><a href='treat-contact.php?id=<?php echo $row["id"] ?>'>Modifier</a> </td>

            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include("../footer.php"); ?>