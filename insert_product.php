<?php
include("config.php");

$name     = $_POST['p_name']     ?? '';
$desc     = $_POST['p_desc']     ?? '';
$price    = $_POST['p_price']    ?? 0;
$stock    = $_POST['p_stock']    ?? 0;
$category = $_POST['p_category'] ?? '';

$author = $_POST['author'] ?? NULL;
$genre  = $_POST['genre']  ?? NULL;
$size   = $_POST['size']   ?? NULL;
$gender = $_POST['gender'] ?? NULL;

// Handle image upload
$image = NULL;
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (in_array($_FILES['image']['type'], $allowed)) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('product_') . '.' . $ext;
        $destination = 'uploads/' . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $image = $filename;
        }
    }
}

$sql = "INSERT INTO produits 
(nom, description, prix, stock, categorie, author, genre, size, gender, image)
VALUES 
('$name','$desc','$price','$stock','$category','$author','$genre','$size','$gender','$image')";

if ($conn->query($sql)) {
    // Redirect back to the right manage page
    switch ($category) {
        case 'books':       header("Location: manageBooks.php"); break;
        case 'clothes':     header("Location: manageClothes.php"); break;
        case 'electronics': header("Location: manageElectronics.php"); break;
        default:            header("Location: manageProducts.php");
    }
    exit;
} else {
    echo "❌ Error: " . $conn->error;
}
?>