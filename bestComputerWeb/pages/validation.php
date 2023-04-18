<?php 

@$case = $_GET["case"];
$title = "";
$message = "";
$link = "";
$linkHref = "";
if(isset($case)){
  switch($case) {
    CASE "register":
      $title = "Inscription Réussie";
      $message = "Nous vous remercions pour votre inscription sur notre plateforme, vous pouvez maintenant vous connecter en vous rendant sur la page suivante !";
      $linkHref = "connection.php";
      $link ="Se connecter";
      break;
    CASE "contact":
      $title = "Message Envoyé";
      $message = "Votre message a bien été envoyé, nous vous invitons à poursuivre votre navigation sur le site";
      $linkHref = "index.php";
      $link ="Page Accueil";
      break;
    CASE "command":
      $title = "Commande Validée";
      $message = "Votre commande a bien été validée, nous vous invitons à découvrir d'autres produits de notre catalogue";
      $linkHref = "search.php";
      $link ="Nos Produits";
      break;
    default:
      header("Location: index.php");
      exit;
  }
} else {
  header("Location: index.php");
}


?>
<?php 
  include ("head.php"); 
?>



 <div id="container" class="container">
  <div class="row">
    <div class="col-3 "></div>
    <div class="col-6" style="padding-top: 5em">
    <h1><?php echo $title; ?></h1>
    <p><?php echo $message; ?></p>
    <a href="<?php echo $linkHref; ?>"><?php echo $link; ?></a>
    </div>
     <div class="col-3"></div>
  </div>
 </div>
 
 <?php include ("footer.php"); ?>