<?php
include("config.php");

$id = $_GET['id'];

// Get the client's email first
$result = $conn->query("SELECT email FROM clients WHERE id=$id");
$row = $result->fetch_assoc();
$email = $row['email'];

// Delete from both tables
$conn->query("DELETE FROM clients WHERE id=$id");
$conn->query("DELETE FROM users WHERE email='$email'");

header("Location: manageClients.php");
?>