<?php
$title = "FAQ ";
include_once("head.php");
?>
<div class="container">
  <div class="p-4 p-md-4 mb-2">
    <h2>Foire Aux Questions</h2>
    <div class="alert alert-primary" role="alert">
      <i class="bi bi-info-circle"></i>
      Sur cette page, nous allons répondre à vos questions les plus fréquentes.
      Si vous ne trouvez pas de réponse pouvant convenir à votre question, n'hésitez pas à prendre <a href="contact.php">contact</a> avec nos équipes, ils se feront une joie de pouvoir vous aider.
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            Commander
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <p class="text-wrap">
              Afin de pouvoir passer commande et avoir accès a votre tableau de bord regroupant vos informations personnelles ainsi que votre historique de commandes, il est nécessaire de créer un compte.
              Le délai de traitement de votre commande est de 5 jours ouvrables en moyenne.
              En cas de retard de notre part, vous en serai informé par mail.
            </p>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            Paiement
          </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">Nous acceptons les paiements par carte bancaire ou PayPal, chaque paiement est entièrement sécurisé.</div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
            Livraison
          </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <p class="text-wrap">
              Toutes vos commandes son livrées par le transporteur Colissimo en France métropolitaine.
              Lors de l’expédition de votre commande, nous vous communiquons toutes les informations de suivi par mail, mais vous pouvez également les retrouver dans votre espace personnel.
              Nous vous invitons à bien inspecter votre colis lors de sa livraison et à refuser tout paquet endommagé.
            </p>
            <p class="text-wrap">Le montant des frais de livraison est de 6,90€ pour les petits colis et de 9,90 € pour les colis plus volumineux.</p>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
            Service après-vente
          </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">Lors de la réception de votre commande, nous vous invitons à bien vérifier son bon fonctionnement. En cas de problème avec celui-ci, prenez immédiatement contact avec nos équipes.</div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php include_once("footer.php"); ?>