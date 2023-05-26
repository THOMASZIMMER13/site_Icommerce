<?php
include ("validateAuth.php");
//connexion à la base de donnée 
require('..\../bd\config.php');
$erreur = '';
$id = 0;
$firstname = '';
$lastname = '';
$email = '';
$subject = '';
$message = '';
$status = '';
$comment  = '';

// Traitement du formulaire
if (isset($_POST['submit'])) {
  $id = stripslashes($_REQUEST['id']);
	$id = mysqli_real_escape_string($conn, $id); 
  
  $comment = stripslashes($_REQUEST['comment']);
	$comment = mysqli_real_escape_string($conn, $comment); 
  
  $status = stripslashes($_REQUEST['status']);
	$status = mysqli_real_escape_string($conn, $status); 

  // Préparation et exécution de la requête d'insertion
  $query = "UPDATE contact SET comment = '$comment', status = '$status' WHERE id = $id";
  // Exécute la requête sur la base de données
  try {
    $res = mysqli_query($conn, $query);
    if($res) {
      header('Location: ConsultMsg.php');
    }
  } catch (Exception $err) {
    $erreur = "Une erreur s'est produite vueillez revenir plus tard sur cette page";
    $erreur = $err;
  }
} else {
  if (isset($_REQUEST["id"])) {
    $query = "SELECT id, firstname, lastname, email, message, comment, subject, status FROM contact WHERE id = ".$_REQUEST["id"];
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);
    if ($data) {
      $id = $data["id"];
      $firstname = $data["firstname"];
      $lastname = $data["lastname"];
      $email = $data["email"];
      $subject = $data["subject"];
      $message= $data["message"];
      $status= $data["status"];
      $comment= $data["comment"];
    }
  }
}

function isSelected($status, $value) {
  if ($status == $value) {
    echo 'selected';
  } else {
    echo '';
  }
}
?>

<?php 
$title= $subject;
  include ("../head.php"); 
?>

<div class="container">
<div class="row">
<h1> <?php echo $title; ?> </h1>

<form method="post">
  <p><?php echo $erreur; ?></p>
  <div class="form-group">
  <label for="firstname">Prénom :</label>
  <input type="text" id="firstname" name="firstname" readonly value="<?php echo $firstname; ?>">
</div>

  <div class="form-group">
  <label for="lastname">Nom :</label>
  <input type="text" name="lastname" id="lastname" readonly value="<?php echo $lastname; ?>">
</div>
<div class="form-group">
  <label for="email">Adresse email :</label>
  <input type="email" id="email" name="email" readonly value="<?php echo $email; ?>">
</div>
<div class="form-group">
  <label for="subject">Sujet :</label>
  <input type="text" name="subject" id="subject" readonly value="<?php echo $subject; ?>">
</div>
<div class="form-group">
  <label for="message">Message :</label>
  <div><?php echo $message; ?></div>
</div>
<div class="form-group">
  <label for="comment">Commentaire :</label>
  <textarea id="comment" name="comment"><?php echo $comment; ?></textarea>
</div>
<div class="form-group">
  <label for="status">Statut :</label>
  <select name="status" >
    <option value="to_treat" <?php isSelected($status, 'to_treat'); ?>> A traiter </option>
    <option value="treated" <?php isSelected($status, 'treated'); ?>> Archiver </option>
  </select>
</div>
  <input type="submit" name="submit" value="Envoyer">
</form>

</div>
</div>

<?php include ("../footer.php"); ?>