<?php
session_start();
require(dirname(__FILE__).'/config.php');
$dashboard = "";
if (isset($_SESSION["role"])) {
  if ($_SESSION["role"] == "client") {
    $dashboard = $BASE_URL ."customer-dashboard.php";
  } else {
    $dashboard = $BASE_URL ."employee-dashboard.php";
  }
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title><?php if ($title) { echo $title . " - ";}?> Best Computer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  
  <body>
    
       <div class="container">
        <div class="row">
          <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="<?php echo $BASE_URL; ?>../index.php">
                <img src="<?php echo $BASE_URL; ?>../images/logo.png" width="100" height="30" alt="Best Computer">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $BASE_URL; ?>../index.php">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#a_propos">A Propos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $BASE_URL; ?>product.php">Nos Produits</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $BASE_URL; ?>basket.php">Mon Panier</a>
                  </li>
                  <?php 
                    if (!empty($dashboard)) {
                      echo "<li class='nav-item'><a class='nav-link' href='".$dashboard."'>Tableau de bord</a></li>";
                    }
                  ?>
                </ul>
                <form class="d-flex" role="search" action="<?php echo $BASE_URL; ?>search.php" method="post">
                  <input class="form-control me-2" type="text" placeholder="Rechercher un produit" name="txt" minlength="2">
                  <input type="submit" class="btn btn-primary" value="Chercher">
                </form>
                <?php if (!isset($_SESSION['id'])) { ?>
                <ul class="navbar-nav">
                  <li><a href="<?php echo $BASE_URL; ?>register.php"> S'inscrire</a> </li>
                  <li><a href="<?php echo $BASE_URL; ?>connection.php"> Se connecter </a> </li>
                </ul> 
                <?php } ?>
              </div>
            </div>
          </nav> 
        </div>
       </div>
       