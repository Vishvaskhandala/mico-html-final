<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "multidoc") or die("Connection failed: " . mysqli_connect_error());

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $user_type = $_POST['user-type'];

    // Initialize an array to hold validation errors
    $errors = [];

    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8 || strlen($password) > 16) {
        $errors[] = "Password must be between 8 and 16 characters.";
    }
    if (!preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/\d/", $password) || !preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        $errors[] = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.";
    }
    if (empty($user_type)) {
        $errors[] = "User type is required.";
    }

    // Check for errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO `users` (`user_name`, `email`, `password`, `user_type`) VALUES (?, ?, ?, ?)");//why ? replace with orignal variable who give the value
        
        // Check if the statement was prepared correctly
        if ($stmt === false) {
            die('MySQL prepare error: ' . htmlspecialchars(mysqli_error($conn)));
        }

        // Bind parameters
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $user_type);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: index.php"); // Redirect after successful registration
            exit();
        } else {
            echo "Registration failed: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
mysqli_close($conn);
?>
