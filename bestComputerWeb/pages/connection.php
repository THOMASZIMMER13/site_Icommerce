<?php 

require('..\bd\config.php');

session_start();
//variables
@$email=$_POST["email"];
//@$pass=sha1 ($_POST["password"]);
@$pass=$_POST["password"];
@$valider=$_POST["valider"];
$erreur="";
$data = null;

if(isset($valider)){
  // récupérer le mail
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email); 
 // Vérification du mail

  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$pass = stripslashes($_REQUEST['password']);
	$pass = mysqli_real_escape_string($conn, $pass);
  
  
  $query = "select * from user where email='".$email."' and pass='".$pass."' limit 1";
  try {
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);
    if($data){
        $_SESSION["prenomnom"]=ucfirst(strtolower ($data["firstname"]))." ".strtoupper($data["lastname"]);
        $_SESSION["authorized"]=true;
        $_SESSION["role"]=$data["role"];
        $_SESSION["email"] = $data["email"];
        $_SESSION["id"] = $data["id"];
        if ($data["role"] == "client") {
          header("Location: customer-dashboard.php");
          exit;
        }
        header("Location: employee-dashboard.php");
        exit;
    }
    else {
        $erreur="Mauvais login ou mot de passe !";
    }
  } catch (Exception $err) {

    $erreur = $err;
    $erreur = 'erreur lors de la tentative de connexion';
  }
}


?>
<?php 
  $title = "Connexion";
  include ("head.php"); 
?>



 <div id="container" class="container">
  <div class="row">
    <div class="col-3 "></div>
    <div class="col-6" style="padding-top: 5em">
    <h1>Connexion </h1>
    <form name="fo" method="post" action="">
     <div class="erreur"><?php echo $erreur;?></div>
     <div class="form-group">
     <label for="login"><b>Email *: </b></label>
     <input type="email" placeholder="example@gmail.com" id="login" name="email" required="true" aria-required="true">
      </div>
      <div class="form-group">
     <label for="pass"><b>Mot de passe *:</b></label>
     <input type="password" placeholder="Entrer le mot de passe" id="pass" name="password" required="true" aria-required="true">
    </div>
    <input type="submit" name="valider" placeholder="Envoyer  "/>
    <input type="reset" name="effacer" placeholder="effacer"/>
    <p>Si vous ne disposez pas d'un compte, <a href="register.php">S'inscrire</a></p>
     </form>
     </div>
     <div class="col-3"></div>
  </div>
 </div>
 
 <?php include ("footer.php"); ?>