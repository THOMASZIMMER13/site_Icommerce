<?php
include_once("head.php");
$case = $_GET["case"];
$title = "";
$message = "";
$link = "";
$linkHref = "";
if (isset($case)) {
  switch ($case) {
    case "register":
      $title = "Inscription réussie !";
      $message = "Nous vous remercions pour votre inscription sur notre plateforme, vous pouvez maintenant vous connecter en vous rendant sur la page suivante !";
      $linkHref = "connection.php";
      $link = "Se connecter";
      break;
    case "contact":
      $title = "Message Envoyé";
      $message = "Votre message a bien été envoyé, nous vous invitons à poursuivre votre navigation sur le site";
      $linkHref = "index.php";
      $link = "Page Accueil";
      break;
    case "command":
      $title = "Commande validée !";
      $message = "Votre commande a bien été validée, nous vous invitons à découvrir d'autres produits de notre catalogue";
      $linkHref = "search.php";
      $link = "Nos Produits";
      break;
    case "address":
      $title = "Ajout ou modification de votre adresse effectuée! ";
      $linkHref = "customer-dashboard.php";
      $link = "Revenir sur votre tableau de bord";
      break;
    default:
      header("Location: index.php");
      exit;
  }
} else {
  header("Location: index.php");
}
?>
<div id="container" class="container">
  <div class="row">
    <div class="col-3 "></div>
    <div class="col-6" style="padding-top: 5em">
      <div class="card border-success mb-3">
        <div class="card-body text-success">
          <h1 class="card-title"><?php echo $title; ?></h1>
          <p class="card-text"><?php echo $message; ?></p>
        </div>
      </div>
      <a class="btn btn-sm btn-primary" role="button" href="<?php echo $linkHref; ?>" class="card-link"><?php echo $link; ?></a>
    </div>
    <div class="col-3"></div>
  </div>
</div>

<?php include_once("footer.php"); ?>