<?php
//	include ("customer/validateAuth.php"); 
//<-- connection à la base de donné -->
	include ("..\bd\config.php"); 
  $user = null;
  session_start();
 
 
 if($_SESSION['email']){
  $query = "SELECT * FROM user WHERE email = '".$_SESSION["email"]."' and role='client' limit 1";
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
  <p> Sur cette page vous pourez consulter vos commandes, mais aussi rentrer vos informations personnelle </p>        

      <ul>
        <li><a href="myInfo.php"> Mes informations personnelles. </a></li>
        <li><a href="customer/commands.php">Liste de mes commandes.  </a></li>
            <li><a href="customer/deleteCession.php"> désactiver mon compte </a>
      </ul>


  <a href="deconnexion_session.php"> Me déconnecter</a>
  </div>
</div>

<?php include ("footer.php"); ?>