<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients</title>
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
            <li><a class="active" href="manageClients.php">Manage Clients</a></li>
            <li><a href="manageCommandes.php">Manage Commandes</a></li>
            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="logout.php">logout</a></li>
            <?php else: ?>
                <li><a href="login.html">login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <section class="admin-panel">
        <div class="table-container">
            <h2>Manage Clients</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM clients");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>#" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['adresse']) . "</td>";
                            echo "<td>
                                    <a href='delete_client.php?id=" . $row['id'] . "' class='btn' onclick='return confirm(\"Delete this client?\")'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No clients found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

</body>
</html>