<?php 
session_start();
include("config.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronics</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">magasin</div>
        <div class="menu">
            <a href=""><i class="fa fa-bars menu"></i></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">home</a></li>
            <li><a href="more.html">More</a></li>
            <li><a href="aboutUs.html">about us</a></li>
            <li><a href="contactUs.html">contact us</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">logout</a></li>
            <?php else: ?>
                <li><a href="login.html">login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <section class="produit-container">
        <?php
        $result = $conn->query("SELECT * FROM produits WHERE categorie='electronics'");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card-produit">';
                echo '  <div class="produit-img-box">';
                $img = $row['image'] ? 'uploads/' . $row['image'] : 'img/electronics.jpg';
                echo '    <img src="' . $img . '" alt="Electronics">';
                echo '  </div>';
                echo '  <div class="produit-info">';
                echo '    <h3>' . htmlspecialchars($row['nom']) . '</h3>';
                echo '    <p class="description">' . htmlspecialchars($row['description']) . '</p>';
                echo '    <p class="price">' . $row['prix'] . ' TND</p>';
                echo '    <a href="add_to_cart.php?id=' . $row['id'] . '" class="btn">add to cart</a>';
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo '<p style="color:white;">No electronics available yet.</p>';
        }
        ?>
    </section>

</body>
</html>