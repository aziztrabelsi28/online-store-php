<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

include("config.php");

$id = $_GET['id'] ?? 0;


$result = $conn->query("SELECT * FROM produits WHERE id=$id");
if ($result->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$product = $result->fetch_assoc();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantite']++;
} else {
    $_SESSION['cart'][$id] = [
        'id'       => $product['id'],
        'nom'      => $product['nom'],
        'prix'     => $product['prix'],
        'image'    => $product['image'],
        'quantite' => 1
    ];
}

header("Location: cart.php");
exit;
?>