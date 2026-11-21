<?php
include("config.php");

$id = $_GET['id'];
$conn->query("DELETE FROM commande_details WHERE commande_id=$id");
$conn->query("DELETE FROM commandes WHERE id=$id");
header("Location: manageCommandes.php");
?>