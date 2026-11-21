<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
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
            <li><a href="logout.php">logout</a></li>
        </ul>
    </nav>

    <section class="admin-panel">
        <div class="table-container">
            <h2>My Cart</h2>

            <?php if (empty($_SESSION['cart'])): ?>
                <p>Your cart is empty. <a href="index.php">Continue shopping</a></p>
            <?php else: ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $item):
                            $subtotal = $item['prix'] * $item['quantite'];
                            $total += $subtotal;
                            $img = $item['image'] ? 'uploads/' . $item['image'] : 'img/default.jpg';
                        ?>
                        <tr>
                            <td><img src="<?= $img ?>" alt="<?= htmlspecialchars($item['nom']) ?>" style="width:60px;height:60px;object-fit:cover;"></td>
                            <td><?= htmlspecialchars($item['nom']) ?></td>
                            <td><?= $item['prix'] ?> DT</td>
                            <td><?= $item['quantite'] ?></td>
                            <td><?= $subtotal ?> DT</td>
                            <td><a href="remove_from_cart.php?id=<?= $item['id'] ?>" class="btn">Remove</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h3 style="margin-top:20px;">Total: <?= $total ?> DT</h3>
                <a href="checkout.php" class="btn">Checkout</a>
                <a href="index.php" class="btn">Continue Shopping</a>
            <?php endif; ?>
        </div>
    </section>

</body>
</html>