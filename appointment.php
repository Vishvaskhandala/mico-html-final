<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php
// Start the session

//session_start();
// print_r($_SESSION);

// Check if the user is logged in

include "menu.php";
if (!isset($_SESSION['user']) ) {
    echo "<div class='alert alert-danger'>You need to be logged in to book an appointment. <a href='login.php'>Login here</a></div>";
    exit(); // Stop further execution of the script
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Book Appointment</h3>
                    <p class="card-text">
                        <strong>Doctor Name:</strong> <?php echo htmlspecialchars($_GET['doctor_name']); ?><br>
                        <strong>Specialization:</strong> <?php echo htmlspecialchars($_GET['specialization']); ?><br>
                    </p>
                    
                    <?php
                    // Database connection
                    $con = mysqli_connect("localhost", "root", "", "multidoc") or die("Connection failed: " . mysqli_connect_error());

                    // Check if the form was submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Get POST data
                        $doctor_id = mysqli_real_escape_string($con, $_POST['doctor_id']);
                        $patient_name = mysqli_real_escape_string($con, $_POST['patient_name']);
                        $appointment_date = mysqli_real_escape_string($con, $_POST['appointment_date']);

                        // Prepare the SQL query
                        $q = "INSERT INTO `appointments` (`doctor_id`, `patient_name`, `appointment_date`) VALUES ('$doctor_id', '$patient_name', '$appointment_date')";

                        // Execute the query
                        if (mysqli_query($con, $q)) {
                            echo "<div class='alert alert-success'>Appointment booked successfully!</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Error: " . mysqli_error($con) . "</div>";
                        }

                        // Close the database connection
                        mysqli_close($con);
                    }
                    ?>

                    <form action="" method="post">
                        <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($_GET['doctor_id']); ?>">
                        <div class="form-group">
                            <label for="patient_name">Your Name:</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" required>
                        </div>
                        <div class="form-group">
                            <label for="appointment_date">Appointment Date:</label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
