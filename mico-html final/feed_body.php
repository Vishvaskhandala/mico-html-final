<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "multidoc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO feedback (name, email, appointment_date, rating, comments) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $name, $email, $appointment_date, $rating, $comments);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$appointment_date = $_POST['appointment-date'];
$rating = $_POST['rating'];
$comments = $_POST['comments'];

if ($stmt->execute()) {
    echo "Feedback submitted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
