<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validation
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } elseif (strlen($password) < 8 || strlen($password) > 16) {
        echo "Password must be between 8 and 16 characters";
    } else {
        $qadmin = "SELECT * FROM admin WHERE email='$username' AND password='$password'";
        $quser = "SELECT * FROM users WHERE email='$username' AND password='$password'";

        $rsAdmin = mysqli_query($conn, $qadmin);
        $rsUser = mysqli_query($conn, $quser);

        if ($rowAdmin = mysqli_fetch_array($rsAdmin)) {
            $_SESSION["admin"] = $rowAdmin;
            header("Location: admin-home.php");
        } elseif ($rowUser = mysqli_fetch_array($rsUser)) {
            $_SESSION["user"] = $rowUser;
            header("Location: index.php");
        } else {
            echo "Invalid username or password";
        }
    }
} else {
    echo "Invalid request method";
}
?>
