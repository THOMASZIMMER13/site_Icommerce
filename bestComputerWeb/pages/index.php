<?php 
  $title = "Accueil";
  include ("head.php"); 
?>

       
      <main>
      <div class="container">
        <div class="row">
          <div class="col p-5 justify">
            <h1>Bienvenue</h1>
            <p>
              Ici vous trouverez les meilleurs ordinateurs du marché.
              Que vous recherchiez un ordinateur portable, un ordinateur de bureau, un écran ou tout autre accessoires nous avons ce qu'il vous faut.
            </p>

          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">

          <h2> Nos produits </h2>

          <ul>
            <li><a href="laptop.php"> Ordinateurs portables </a></li>
            <li><a href="desktop.php"> Ordinateurs de bureau </a></li>      
            <li><a href="accessory.php"> Accessoires et périphériques </a></li>      
          </ul>
        </div>
      </div>

<?php include("qui sommes-nous.php"); ?>


      
    </main>

    <?php include ("footer.php"); ?>

