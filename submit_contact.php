<?php

$conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$message = "";
$is_error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $full_name = $conn->real_escape_string($_POST['full_name']);
  $email = $conn->real_escape_string($_POST['email']);
  $phone_number = $conn->real_escape_string($_POST['phone_number']);
  $message = $conn->real_escape_string($_POST['message']);

  $sql = "INSERT INTO contacts (full_name, email, phone_number, message) VALUES ('$full_name', '$email', '$phone_number', '$message')";

  if ($conn->query($sql) === TRUE) {
    $message = "New record created successfully";
  } else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
    $is_error = true;
  }

  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        .message {
            padding: 10px;
            margin: 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border-radius: 5px;
            text-align: center;
        }
        .message.error {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="message <?php echo $is_error ? 'error' : ''; ?>">
        <?php echo $message; ?>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 3000); // Redirects after 3 seconds
    </script>
</body>
</html>
