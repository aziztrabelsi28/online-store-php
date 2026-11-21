<?php
include("config.php");

$client_id = $_POST['client_id'];
$produit_id = $_POST['produit_id'];
$quantite = $_POST['quantite'];

$conn->query("INSERT INTO commandes (client_id) VALUES ($client_id)");
$commande_id = $conn->insert_id;

$conn->query("INSERT INTO commande_details (commande_id, produit_id, quantite)
VALUES ($commande_id, $produit_id, $quantite)");

echo "✅ Order created!";
?>