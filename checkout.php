<?php
session_start();
include("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get client_id from clients table using user email
$user_result = $conn->query("SELECT email FROM users WHERE id=$user_id");
$user = $user_result->fetch_assoc();
$email = $user['email'];

$client_result = $conn->query("SELECT id FROM clients WHERE email='$email'");
$client = $client_result->fetch_assoc();
$client_id = $client['id'];

// Create the order
$date = date('Y-m-d H:i:s');
$conn->query("INSERT INTO commandes (client_id, date_commande) VALUES ('$client_id', '$date')");
$commande_id = $conn->insert_id;

// Insert each cart item into commande_details
foreach ($_SESSION['cart'] as $item) {
    $produit_id = $item['id'];
    $quantite   = $item['quantite'];
    $conn->query("INSERT INTO commande_details (commande_id, produit_id, quantite) 
                  VALUES ('$commande_id', '$produit_id', '$quantite')");
}

// Clear the cart
$_SESSION['cart'] = [];

echo "✅ Order placed successfully!";
echo "<br><a href='index.php'>Continue Shopping</a>";
?>