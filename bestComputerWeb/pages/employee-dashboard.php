<?php

//connection à la base de donné
	include ("../bd/config.php"); 
  $user = null;
  session_start();
 
 
 if($_SESSION['email'] && $_SESSION["role"] != "client"){
  $query = "SELECT * FROM user WHERE email = '".$_SESSION["email"]."' limit 1";
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);
  if (!$user) {
    header("Location: error.php");
  }
 } else {
   header("Location: error.php");
 }
 ?>

<?php 
  $title = "Tableau de bord";
  include ("head.php"); 
?>
<div class="container">
  <div class="row">
<h1> Bienvenue sur votre espace <?php echo $_SESSION["prenomnom"]?> ! </h1>

    <ul>
<li> <a href="myInfo.php"> Consulter mes informations personnelle </a> </li>
      <li><a href="employe/lstProduct.php">Gérer le stock. </a></li>
	        <li><a href="employe/lstEmploye.php">Géré les employés de l'entreprise. </a></li>
	        <li><a href="employe/commands.php">Visualiser les commandes en cours de traitements. </a></li>
	        <li><a href="employe/consultMsg.php">Visualiser les messages reçu via le formulaire de contact.</a></li>
<li> <a href="employe/deleteCession.php"> désactiver mon compte </a>
    </ul>


<a href="deconnexion_session.php"> Me déconnecter</a>
</div>
</div>
<?php include ("footer.php"); ?>
