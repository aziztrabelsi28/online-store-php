<?php
include("config.php");

$nom     = $_POST['nom']      ?? '';
$prenom  = $_POST['prenom']   ?? '';
$email   = $_POST['email']    ?? '';
$adresse = $_POST['adresse']  ?? '';
$password = $_POST['password'] ?? '';

$full_nom = $nom . ' ' . $prenom;

// Check if email already exists
$check = $conn->query("SELECT * FROM users WHERE email='$email'");

if ($check->num_rows > 0) {
    echo "❌ Email already exists!";
} else {
    // Insert into users table (for login)
    $sql_user = "INSERT INTO users (email, password, role)
                 VALUES ('$email', '$password', 'client')";

    // Insert into clients table (for management)
    $sql_client = "INSERT INTO clients (nom, email, adresse)
                   VALUES ('$full_nom', '$email', '$adresse')";

    if ($conn->query($sql_user) && $conn->query($sql_client)) {
        echo "✅ Registered successfully!";
        echo "<br><a href='login.html'>Login now</a>";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>