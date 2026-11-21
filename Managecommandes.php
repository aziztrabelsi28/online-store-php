<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Commandes</title>
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
            <li><a class="active" href="manageCommandes.php">Manage Commandes</a></li>
            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="logout.php">logout</a></li>
            <?php else: ?>
                <li><a href="login.html">login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <section class="admin-panel">
        <div class="table-container">
            <h2>Manage Commandes</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Products</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("
                        SELECT 
                            c.id, 
                            c.date_commande, 
                            cl.nom AS client_nom,
                            GROUP_CONCAT(p.nom, ' (x', cd.quantite, ')' SEPARATOR ', ') AS produits,
                            SUM(p.prix * cd.quantite) AS total
                        FROM commandes c
                        LEFT JOIN clients cl ON c.client_id = cl.id
                        LEFT JOIN commande_details cd ON c.id = cd.commande_id
                        LEFT JOIN produits p ON cd.produit_id = p.id
                        GROUP BY c.id
                        ORDER BY c.date_commande DESC
                    ");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>#" . $row['id'] . "</td>";
                            echo "<td>" . $row['date_commande'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['client_nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['produits']) . "</td>";
                            echo "<td>" . $row['total'] . " DT</td>";
                            echo "<td>
                                    <a href='delete_commande.php?id=" . $row['id'] . "' class='btn' onclick='return confirm(\"Delete this order?\")'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

</body>
</html>