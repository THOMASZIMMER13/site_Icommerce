<?php
$title = "Nous contacter ";
include_once("head.php");

$erreur = '';

// Traitement du formulaire
if (isset($_POST['Envoyer'])) {
  /**
   * Récupération des données
   * LASTNAME
   * FIRSTNAME
   * EMAIL
   * SUBJECT
   * MESSAGE
   */
  $lastname = mysqli_real_escape_string($conn, $_REQUEST['lastname']);
  $firstname = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
  $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
  $subject = mysqli_real_escape_string($conn, $_REQUEST['subject']);
  $message = mysqli_real_escape_string($conn, $_REQUEST['message']);

  // Préparation et exécution de la requête d'insertion
  $query = "INSERT into contact (firstname, lastname, email, subject, message, status) VALUES ('$firstname', '$lastname', '$email', '$subject', '$message', 'to_treat');";
  // Exécute la requête sur la base de données
  try {
    $res = mysqli_query($conn, $query);
    if ($res) {
      header('Location: validation.php?case=contact');
    }
  } catch (Exception $err) {
    $erreur = "Une erreur s'est produite vueillez revenir plus tard sur cette page";
    $erreur = $err;
  }
}
?>

<div class="container">
  <div class="p-4 p-md-4 mb-2">
    <h1><?php echo $title; ?></h1>
    <div class="alert alert-primary" role="alert">
      <i class="bi bi-info-circle"></i>
      Vous souhaitez obtenir des informations sur un produit en particulier, sur une compatibilité de matériel ?
      Vous avez une commande en cours et voulez la modifier ? Une demande de retour à effectuer ?
      Vous pouvez nous contacter par mail ou par téléphone, pensez également à consulter notre <a href="FAQ.php">Foire Aux Questions</a>, vous y trouverez des réponses à vos interrogations !
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-2" style="padding-bottom: 2em">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title"> Via le formulaire </h2>
            <form action="" method="post" class="grid">
              <p><?php echo $erreur; ?></p>
              <div class="mb-4 row">
                <label for="lastname" class="col-sm-4 col-form-label">Nom *:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
              </div>
              <div class="mb-4 row">
                <label for="firstname" class="col-sm-4 col-form-label">Prénom *:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
              </div>
              <div class="mb-4 row">
                <label for="email" class="col-sm-4 col-form-label">Email *:</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
              </div>
              <div class="mb-4 row">
                <label for="subject" class="col-sm-4 col-form-label">Sujet *:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
              </div>
              <div class="mb-4 row">
                <label for="subject" class="col-sm-4 col-form-label">Message *:</label>
                <div class="col-sm-8">
                  <textarea id="message" class="form-control" name="message" rows="5"></textarea>
                </div>
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                <input class="btn btn-sm btn-outline-danger" type="reset" name="Effacer" placeholder="effacer" />
                <input class="btn btn-sm btn-success" type="submit" name="Envoyer" placeholder="Envoyer" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title"> Nous sommes également joignable</h2>
            <div>
              <h3>Par E-mail</h3>
              <p> Lors de l'envoi de votre mail à nos experts pensez à joindre votre n° de commande dans l'objet </p>
              <a href="mailto:email@example.com" class="btn btn-primary">Envoyer un email</a>
            </div>
            <hr />
            <div>
              <h3>Par téléphone</h3>
              <p class="text-wrap">
                Nos conseillers sont à votre disposition du lundi au vendredi de 9h à 18h.<br/>
                Lors de votre appel au standard, pensez à vous munir de votre numéro de commande.
              </p>
              <a class="btn btn-primary" href="tel:+33472010203">Appeler le 04 72 01 02 03</a> <small>(numéro non surtaxé)</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>