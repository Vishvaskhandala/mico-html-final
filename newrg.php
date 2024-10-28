

<!-- register_code.php -->
<?php
// $conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());

// $username = $_POST['username'];
// $password = $_POST['password'];
// $email = $_POST['email'];

// $q="INSERT INTO users (username, password, email) VALUES ('$username','$password','$email')";

// if(mysqli_query($conn,$q)){
//     echo "success";
// }else{

//     echo "fail";
// }

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());

// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

//$user_type = $_POST['user-type']; // New user type field

// Insert data into the users table
$q = "INSERT INTO `users` (`user_name`, `email`, `password`) VALUES ('$username', '$email', '$password')";
// $q = "INSERT INTO users (user_id,username, password, email,) VALUES ('$username', '$password', '$email', '$user_type')";
if (mysqli_query($conn, $q)) {
    echo "Registration successful!";

    header("Location: index.php");
} else {
    echo "Registration failed: " . mysqli_error($conn);
}


// Close the database connection
mysqli_close($conn);



?>




