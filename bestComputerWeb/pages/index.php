<?php
$title = "Accueil";
include_once("head.php");

$dashboard = "";
if (isset($_SESSION["role"])) {
  if ($_SESSION["role"] == "client") {
    $dashboard = $BASE_URL . "customer-dashboard.php";
  } else {
    $dashboard = $BASE_URL . "employee-dashboard.php";
  }
}
?>

<div style="background-color:#4bb8d3; color:#ffffff;">
  <div class="container p-4 p-md-5 mb-4">
    <div class="row justify-content-center">
      <div class="col-3" style="margin:auto;">
        <img src="../Images/logo.png" class="img-fluid d-block" alt="Image">
      </div>
      <div class="col-9 align-middle p-4" style="margin:auto; padding: 5em">
        <h1>BEST COMPUTER</h1>
        <h3>Votre référent technologique, près de chez vous !</h3>
        <p class="text-break">
          <span>Ici vous trouverez les meilleurs ordinateurs du marché.</span>
          <span>Que vous recherchiez un ordinateur portable, un ordinateur de bureau, un écran ou tout autre accessoires nous avons ce qu'il vous faut.</span>
        </p>
      </div>
    </div>
  </div>
</div>
<div>
  <div class="container p-4 p-md-5 mb-4">
    <h2> Nos produits </h2>
    <div class="row row-cols-1 row-cols-md-3 g-3">
      <div class="col">
        <div class="card text-center">
          <img src="../Images/laptop/img01.jpg" class="card-img-top img-fluid" style="max-height:150px;max-width:200px;margin:auto;" alt="...">
          <div class="card-body">
            <h5 class="card-title"> Ordinateurs portables </h5>
            <a href="laptop.php" class="btn btn-primary">Découvrir</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center">
          <img src="../Images/desktop/img01.jpg" class="card-img-top img-fluid" style="max-height:150px;max-width:200px;margin:auto;" alt="...">
          <div class="card-body">
            <h5 class="card-title"> Ordinateurs de bureau </h5>
            <a href="desktop.php" class="btn btn-primary">Découvrir</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center">
          <img src="../Images/accessory/img01.jpg" class="card-img-top img-fluid" style="max-height:150px;max-width:200px;margin:auto;" alt="...">
          <div class="card-body">
            <h5 class="card-title"> Accessoires et périphériques </h5>
            <a href="accessory.php" class="btn btn-primary">Découvrir</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="background-color:#4bb8d3;">
  <div class="container p-4 p-md-5 mb-4">
    <h2 style="color:#ffffff;"> Acheter chez nous, c'est synonyme de...</h2>
    <div class="row row-cols-1 row-cols-md-3 g-3">
      <div class="col">
        <div class="card text-center border-primary">
          <div class="card-body">
            <i class="bi bi-star" style="font-size: 3rem;"></i>
            <h5 class="card-title"> 10 ans d'expérience </h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center border-primary">
          <div class="card-body">
            <i class="bi bi-pc-display" style="font-size: 3rem;"></i>
            <h5 class="card-title"> + de 15 000 références </h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center border-primary">
          <div class="card-body">
            <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
            <h5 class="card-title"> Livraison sous 48h </h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center border-primary">
          <div class="card-body">
            <i class="bi bi-award" style="font-size: 3rem;"></i>
            <h5 class="card-title"> Label écoresponsable </h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center border-primary">
          <div class="card-body">
            <i class="bi bi-chat-left-dots-fill" style="font-size: 3rem;"></i>
            <h5 class="card-title"> Une équipe locale & made in France </h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center border-primary">
          <div class="card-body">
            <i class="bi bi-gear" style="font-size: 3rem;"></i>
            <h5 class="card-title"> Reprise de vos anciens appareils </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <div class="container p-4 p-md-5 mb-4">
    <h2>Une équipe locale et à votre écoute</h2>
    <p class="text-wrap">
      Best Computer est une jeune start-up lyonnaise fondée en 2020 par Thomas.
      Passionné d’informatique, ce jeune trentenaire est parti du constat que si beaucoup d’entreprises proposent à la vente divers matériel informatique, le client se retrouvait parfois perdu face à la multitude de produits disponibles sur le marché.
      C’est dans le but de répondre à ce besoin très précis que Best Computer est né.
    </p>
    <p class="text-wrap">
      Sur notre site, vous pourrez non seulement retrouver divers matériel informatique à la vente, mais vous trouverez surtout une solution entièrement personnalisée pour répondre au mieux à vos attentes.
      Qu’elles soient professionnelles, personnelles ou que vous soyez un futur informaticien en herbe, nos conseillés seront là pour vous écouter, vous conseiller et vous assurer de vous retrouver avec les bonnes clés, ou le bon clavier en main.
      Ils seront en mesure de vous accompagner pour passer commande, de vous informer de son avancée et de vous accompagner pour un service après-vente de qualité.
    </p>
    <p class="text-wrap">
      Nous avons voulu ce site simple, clair et efficace.
      Vous ne pourrez assurément pas vous perdre en survolant nos catégories, chaque produit se trouve à la bonne place et chaque prix est mis en évidence, sans surprise.
      Notre algorithme spécialement élaboré sera également capable de vous suggérer le meilleur matériel d’après votre profil et de vous suggérer les accessoires adéquats.
      Et si votre produit n’est pas disponible, pas de panique !
    </p>
    Vous pouvez vous abonner à une alerte afin d’être immédiatement prévenu lors de son retour sur notre e-shop.
    <br />
    Bonne navigation !
  </div>
</div>
</div>
<?php include_once("footer.php"); ?>