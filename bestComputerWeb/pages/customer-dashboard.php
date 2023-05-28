<?php
$title = "Tableau de bord";
include_once("head.php");

$user = null;

if ($_SESSION['email']) {
  $query = "SELECT id, role, male, lastname, firstname, email, pass FROM user WHERE email = '" . $_SESSION["email"] . "' and role='client' limit 1";
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);
  if (!$user) {
    header("Location: error.php");
  }
} else {
  header("Location: error.php");
}
?>

<div class="container p-4 p-md-5 mb-4">
  <h1> Bienvenue sur votre espace <?php echo $_SESSION["prenomnom"] ?> ! </h1>
  <p> Sur cette page vous pourez consulter vos commandes, mais aussi rentrer vos informations personnelle </p>
  <div class="row row-cols-1 row-cols-md-3 g-3">
    <div class="col">
      <div class="card text-center border-dark">
        <div class="card-body">
          <i class="bi bi-star" style="font-size: 3rem;"></i>
          <h5 class="card-title">Mes informations personnelles</h5>
          <a href="myInfo.php" class="btn btn-primary">Consulter</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-dark">
        <div class="card-body">
          <i class="bi bi-house-add-fill" style="font-size: 3rem;"></i>
          <h5 class="card-title">Mon adresse</h5>
          <a href="customer/address.php" class="btn btn-primary">Accéder</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-dark">
        <div class="card-body">
          <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
          <h5 class="card-title">Mes commandes</h5>
          <a href="customer/commands.php" class="btn btn-primary">Accéder</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-dark">
        <div class="card-body">
          <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
          <h5 class="card-title">Supprimer mon compte</h5>
          <a href="customer/deleteCession.php" class="btn btn-primary">Exécuter</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center text-bg-danger border-dark">
        <div class="card-body">
          <i class="bi bi-power" style="font-size: 3rem;"></i>
          <h5 class="card-title">Déconnexion</h5>
          <a href="deconnexion_session.php" class="btn btn-sm btn-danger"> Me déconnecter</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once("footer.php"); ?>