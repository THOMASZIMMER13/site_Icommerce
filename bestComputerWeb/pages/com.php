<?php
require('../bd/config.php');
session_start();
if (!isset($_SESSION['email'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
    header('Location: connection.php');
    exit;
}


// Récupération des commandes de l'utilisateur
$stmt = $mysqli->prepare('SELECT command.id, command.date, command.status, product.title, product_command.Quantity
                          FROM command
                          JOIN product_command ON command.id = product_command.commandId
                          JOIN product ON product_command.productId = product.id
                          WHERE command.userId = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$commands = $result->fetch_all(MYSQLI_ASSOC);

// Affichage des commandes
foreach ($commands as $command) {
    echo '<p>';
    echo 'Commande n° ' . $command['id'] . ' du ' . $command['date'] . ':<br>';
    echo 'Produit : ' . $command['title'] . '<br>';
    echo 'Quantité : ' . $command['Quantity'] . '<br>';
    echo 'Statut : ' . $command['status'] . '<br>';
    echo '<a href="cancel_command.php?id=' . $command['id'] . '">Annuler la commande</a>';
    echo '</p>';
}
?>
