<?php
session_start();
include("config.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if ($user['password'] == $password) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }

    } else {
        echo "❌ Wrong password";
    }

} else {
    echo "❌ Email not found";
}
?>