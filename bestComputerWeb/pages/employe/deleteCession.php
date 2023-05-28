<?php
$title = "Suppression compte";
include_once("../head.php");
include_once("validateAuth.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
  // Rediriger l'utilisateur vers la page de connexion
  header("Location: ../connection.php");
  exit();
} else {
  // Supprimer toutes les informations de l'utilisateur de la base de données
  $query = "DELETE FROM user WHERE userId =".$_SESSION['id'];
  try {
    $res = mysqli_query($conn, $query);
    $result = $res;
    if ($res) {
      session_destroy();
      $result = 'Votre compte a été supprimé avec succès.';
      header("Location: ../index.php");
      exit();
    }
  } catch (Exception $err) {
    $erreur = $err;
  }
}