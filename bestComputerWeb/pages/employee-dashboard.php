<?php
$title = "Tableau de bord";
include_once("head.php");

//connection à la base de donné
// include ("../bd/config.php"); 
$user = null;
// session_start();
if ($_SESSION['email'] && $_SESSION["role"] != "client") {
  $query = "SELECT id, role, male, lastname, firstname, email, pass FROM user WHERE email = '" . $_SESSION["email"] . "' limit 1";
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);
  if (!$user) {
    header("Location: error.php");
  }
} else {
  header("Location: error.php");
}
?>
<div class="container">

  <div class="p-4 p-md-4 mb-2">
    <h2>Bienvenue sur votre espace <?php echo $_SESSION["prenomnom"] ?> !</h2>
  </div>

  <div class="row row-cols-1 row-cols-md-4 g-4" style="padding-bottom: 3em">
    <div class="col">
      <div class="card text-center border-primary">
        <div class="card-body">
          <i class="bi bi-star" style="font-size: 3rem;"></i>
          <h5 class="card-title">Mes informations personnelles</h5>
          <a href="myInfo.php" class="btn btn-primary">Consulter</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-primary">
        <div class="card-body">
          <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
          <h5 class="card-title">Gestion du stock</h5>
          <a href="employe/lstProduct.php" class="btn btn-primary">Accéder</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-primary">
        <div class="card-body">
          <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
          <h5 class="card-title">Gérer les collaborateurs</h5>
          <a href="employe/lstEmploye.php" class="btn btn-primary">Accéder</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-primary">
        <div class="card-body">
          <i class="bi bi-card-checklist" style="font-size: 3rem;"></i>
          <h5 class="card-title">Gérer les commandes</h5>
          <a href="employe/commands.php" class="btn btn-primary">Accéder</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-primary">
        <div class="card-body">
          <i class="bi bi-chat-left-text" style="font-size: 3rem;"></i>
          <h5 class="card-title">Gérer les messages</h5>
          <a href="employe/consultMsg.php" class="btn btn-primary">Accéder</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card text-center border-primary">
        <div class="card-body">
          <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
          <h5 class="card-title">Désactiver mon compte</h5>
          <a href="employe/deleteCession.php" class="btn btn-primary">Exécuter</a>
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