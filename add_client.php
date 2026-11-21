<?php
include("config.php");

$nom = $_POST['nom'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];

$sql = "INSERT INTO clients (nom, email, adresse)
VALUES ('$nom', '$email', '$adresse')";

if ($conn->query($sql)) {
    echo "Client added!";
} else {
    echo "Error: " . $conn->error;
}
?>