<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
            <li><a class="active" href="manageProducts.php">Manage products</a></li>
            <li><a href="manageClients.php">Manage Clients</a></li>
            <li><a href="manageCommandes.php">Manage Commandes</a></li>
            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="logout.php">logout</a></li>
            <?php else: ?>
                <li><a href="login.html">login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <section class="admin-panel">
        <section class="choices">
            <div class="card">
                <div class="image-box clothes"></div>
                <a href="manageClothes.php" class="btn">clothes</a>
            </div>
            <div class="card">
                <div class="image-box electronics"></div>
                <a href="manageElectronics.php" class="btn">electronics</a>
            </div>
            <div class="card">
                <div class="image-box books"></div>
                <a href="manageBooks.php" class="btn">books</a>
            </div>
        </section>
    </section>

</body>
</html>