<!-- register_code.php -->
<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());

// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validation
$errors = [];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
}

if (strlen($password) < 8 || strlen($password) > 16) {
    $errors[] = "Password must be between 8 and 16 characters";
}

if (empty($username) || empty($email) || empty($password)) {
    $errors[] = "All fields are required";
}

// Check for errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} else {
    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Insert data into the users table
    $q = "INSERT INTO `users` (`user_name`, `email`, `password`) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $q)) {
        echo "Registration successful!";
        header("Location: index.php");
        exit();
    } else {
        echo "Registration failed: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
