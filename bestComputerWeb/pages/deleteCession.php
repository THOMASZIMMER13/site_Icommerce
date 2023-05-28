<?php
require_once "../bd/config.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  // Rediriger l'utilisateur vers la page de connexion
  header("Location: connection.php");
  exit();
}




// Récupérer l'ID de l'utilisateur en cours
$user_id = $_SESSION['user_id'];

// Supprimer toutes les informations de l'utilisateur de la base de données
$stmt = $conn->prepare("DELETE * FROM user WHERE user_id =?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Supprimer l'utilisateur de la base de données
$stmt = $conn->prepare("DELETE * FROM user WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

if ($conn->query($sql) === TRUE) {
    // Déconnexion de l'utilisateur
    session_destroy();

    // Afficher un message de confirmation
    echo "Votre compte a été supprimé avec succès.";

// Rediriger l'utilisateur vers la page d'accueil
header("Location: register.php");
exit();

} else {
    echo "Une erreur s'est produite : " . $conn->error;
}

?>