<?php
//connexion à la base de donnée 
require('..\bd\config.php');
$erreur = '';

// Traitement du formulaire
if (isset($_POST['submit'])) {
  // récupérer le nom
	$lastname = stripslashes($_REQUEST['lastname']);
	$lastname = mysqli_real_escape_string($conn, $lastname); 

  // récupérer le prénom
	$firstname = stripslashes($_REQUEST['firstname']);
	$firstname = mysqli_real_escape_string($conn, $firstname); 

	// récupérer le mail
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn, $email); 
  
  $subject = stripslashes($_REQUEST['subject']);
	$subject = mysqli_real_escape_string($conn, $subject); 
  
  $message = stripslashes($_REQUEST['message']);
	$message = mysqli_real_escape_string($conn, $message); 

  // Préparation et exécution de la requête d'insertion
  $query = "INSERT into contact (firstname, lastname, email, subject, message, status) VALUES ('$firstname', '$lastname', '$email', '$subject', '$message', 'to_treat');";
  // Exécute la requête sur la base de données
  try {
    $res = mysqli_query($conn, $query);
    if($res) {
      header('Location: validation.php?case=contact');
    }
  } catch (Exception $err) {
    $erreur = "Une erreur s'est produite vueillez revenir plus tard sur cette page";
    $erreur = $err;
  }
}
?>

<?php 
$title="Nous contacter ";
  include ("head.php"); 
?>

<div class="container">
<div class="row">
<h1> <?php echo $title; ?> </h1>
<p>
Vous souhaitez obtenir des informations sur un produit en particulier, sur une compatibilité de matériel ? Vous avez une commande en cours et voulez la modifier ? Une demande de retour à effectuer ?
Vous pouvez nous contacter par mail ou par téléphone, pensez également à consulter notre Foire Aux Questions, vous y trouverez des réponses à vos interrogations !
</p>
<a href="FAQ.php"> cliquez-ici pour accèder à notre foire aux questions </a>
<h2> Via le formulaire </h2>

<form method="post">
  <p><?php echo $erreur; ?></p>
  <div class="form-group">
  <label for="firstname">Prénom :</label>
  <input type="text" id="firstname" name="firstname" required>
</div>

  <div class="form-group">
  <label for="lastname">Nom :</label>
  <input type="text" name="lastname" id="lastname" required><br>
</div>
<div class="form-group">
  <label for="email">Adresse email :</label>
  <input type="email" id="email" name="email" required><br>
</div>
<div class="form-group">
  <label for="subject">Sujet :</label>
  <input type="text" name="subject" id="subject" required><br>
</div>
<div class="form-group">
  <label for="message">Message :</label>
  <textarea id="message" name="message" rows="5"></textarea><br>
</div>
  <input type="submit" name="submit" value="Envoyer">
  <input type="reset" name="reset" value="Effacer">
</form>
<br>

<h2> Nous sommes également joignable Par E-mail ou par téléphone </h2>

<p> Lors de l'envoi de votre mail à nos Expères pensez à joindre votre n° de commande dans l'objet </p>

<a href="mailto:email@example.com">Envoyer Email</a>

<br>
                            <a class="o-link--reset" href="tel:+33472010203">
                                04 72 01 02 03
                            </a>
                        <small>(numéro non surtaxé)</small>
<p>
lors de votre appel au standard
pensez à vous munir de votre numéro de commande
</p> 
<p>
Nos conseillers sont à votre disposition du lundi au vendredi de 9h à 18h. 
</p>
</div>
</div>

<?php include ("footer.php"); ?>