<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>magasin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <header class="home">
        <div class="header-content">
            <h1>everything all at once</h1>
            <h2>easy</h2>
        </div>
    </header>

    <nav class="navbar">
        <div class="logo">magasin</div>
        <div class="menu">
            <a href=""><i class="fa fa-bars menu"></i></a>
        </div>
        <ul class="nav-links">
            <li><a class="active" href="index.php">home</a></li>
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

    <section class="choices">
        <div class="card">
            <div class="image-box clothes"></div>
            <a href="clothes.php" class="btn">clothes</a>
        </div>
        <div class="card">
            <div class="image-box electronics"></div>
            <a href="electronics.php" class="btn">electronics</a>
        </div>
        <div class="card">
            <div class="image-box books"></div>
            <a href="books.php" class="btn">books</a>
        </div>
    </section>

</body>
</html>