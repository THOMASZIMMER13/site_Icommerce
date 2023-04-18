<?php
/*déconnexion de la session et 
redirection vers la page de connexion
*/

session_start();
session_destroy();
header("location:connection.php");
?>