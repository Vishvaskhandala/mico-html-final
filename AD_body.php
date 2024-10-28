<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register-multi-doctor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .signup-container h2 {
            margin-bottom: 20px;
        }

        .signup-container label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .signup-container input, .signup-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .signup-container button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .signup-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>ADD doctor</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $con = mysqli_connect("localhost", "root", "", "multidoc") or die("Connection failed");

            $doctor_id = mysqli_real_escape_string($con, $_POST['doctor_id']);
            $doctor_name = mysqli_real_escape_string($con, $_POST['doctor_name']);
            $specialization = mysqli_real_escape_string($con, $_POST['specialization']);
            $profile = mysqli_real_escape_string($con, $_POST['profile']);
            $availability = mysqli_real_escape_string($con, $_POST['availability']);

            // Save the image in the upload folder
            $upload_dir = 'uploads/';
            $image = $upload_dir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);

            $q = "INSERT INTO doctors (doctor_id, doctor_name, image, specialization, profile, availability) VALUES ('$doctor_id', '$doctor_name', '$image', '$specialization', '$profile', '$availability')";

            if (mysqli_query($con, $q)) {
                echo "<script>alert('Doctor added successfully!');</script>";
                echo "<script>window.location.href='admin-home.php';</script>";
            } else {
                echo "<div class='alert alert-danger'>Failed to add doctor. Error: " . mysqli_error($con) . "</div>";
            }

            mysqli_close($con);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="doctor_id">DOCTOR_ID</label>
            <input type="text" id="doctor_id" name="doctor_id" required>

            <label for="doctor_name">Doctor Name</label>
            <input type="text" id="doctor_name" name="doctor_name" required>

            <label for="image">Doctor Photo</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <label for="specialization">Specialization</label>
            <input type="text" id="specialization" name="specialization" required>

            <label for="profile">Profile</label>
            <input type="text" id="profile" name="profile" required>

            <label for="availability">Availability</label>
            <input type="text" id="availability" name="availability" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
