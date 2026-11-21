<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            <li><a href="manageProducts.php">Manage products</a></li>
            <li><a href="manageClients.php">Manage Clients</a></li>
            <li><a href="manageCommandes.php">Manage Commandes</a></li>
            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="logout.php">logout</a></li>
            <?php else: ?>
                <li><a href="login.html">login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="home">
        <div class="header-content">
            <h1>admin dashboard</h1>
        </div>
    </header>

</body>
</html>