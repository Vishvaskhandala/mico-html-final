<?php
session_start();
$conn = new mysqli("localhost", "root", "", "multidoc");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Validate email format only
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        // Handle login based on user type
        if ($user_type === 'admin') {
            // Admin login
            $stmtAdmin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
            $stmtAdmin->bind_param("ss", $username, $password);
            $stmtAdmin->execute();
            $resultAdmin = $stmtAdmin->get_result();

            if ($rowAdmin = $resultAdmin->fetch_assoc()) {
                $_SESSION["admin"] = $rowAdmin;
                header("Location: admin-home.php");
                exit;
            } else {
                echo "Invalid admin credentials";
            }

            $stmtAdmin->close();
        } else {
            // Client or Doctor login
            $stmtUser = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND user_type = ?");
            $stmtUser->bind_param("sss", $username, $password, $user_type);
            $stmtUser->execute();
            $resultUser = $stmtUser->get_result();

            if ($rowUser = $resultUser->fetch_assoc()) {
                $_SESSION["user"] = $rowUser;

                if ($user_type === 'client') {
                    header("Location: index.php");
                } elseif ($user_type === 'doctor') {
                    header("Location: doctor-home.php");
                }
                exit;
            } else {
                echo "Invalid username, password, or user type";
            }

            $stmtUser->close();
        }
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
