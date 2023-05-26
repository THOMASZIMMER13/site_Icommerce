<?php
// Démarrer la session
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Effacer le cookie de session s'il existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header("Location: connection.php");
exit();
?>
