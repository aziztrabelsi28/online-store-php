<?php
include("config.php");

$result = $conn->query("SELECT * FROM produits");

while($row = $result->fetch_assoc()){
    echo "<div style='border:1px solid #ccc; padding:10px; margin:10px'>";
    echo "<h3>".$row['nom']."</h3>";
    echo "<p>".$row['description']."</p>";
    echo "<p>💰 ".$row['prix']." DT</p>";
    echo "<p>📦 Stock: ".$row['stock']."</p>";
    echo "</div>";
}
?>