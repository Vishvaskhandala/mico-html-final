<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Home - Mico Hospital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .appointment-section, .feedback-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .appointment-section h2, .feedback-section h2 {
            color: #333;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<>

    <?php 
    session_start(); // Start the session
    include "doctor_menu.php"; 

    $conn = mysqli_connect("localhost", "root", "", "multidoc");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>

    <div class="container">
        <h1>Doctor Dashboard</h1>

        <!-- Appointments Section -->
        <div class="appointment-section">
            <h2>Upcoming Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $doctor_id = $_SESSION['user']['user_id']; // Ensure this is set and valid
                    $appointments_query = "SELECT u.user_name AS client_name, a.appointment_date AS date, a.created_at AS time
                                           FROM appointments a 
                                           JOIN users u ON a.patient_name = u.user_name 
                                           WHERE a.doctor_id = '$doctor_id' AND u.user_type = 'client'";
                    $appointments_result = mysqli_query($conn, $appointments_query);
                    if (!$appointments_result) {
                        die("Error in appointments query: " . mysqli_error($conn));
                    }
                    while ($appointment = mysqli_fetch_assoc($appointments_result)) {
                        echo "<tr>
                                <td>{$appointment['client_name']}</td>
                                <td>{$appointment['date']}</td>
                                <td>{$appointment['time']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Feedback Section -->
        <div class="feedback-section">
            <h2>Client Feedback</h2>
            <table>
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Comments</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $feedback_query = "SELECT f.name AS client_name, f.comments AS feedback, f.created_at AS date 
                                       FROM feedback f 
                                       WHERE f.id IN (SELECT id FROM appointments WHERE doctor_id = '$doctor_id')";
                    $feedback_result = mysqli_query($conn, $feedback_query);
                    if (!$feedback_result) {
                        die("Error in feedback query: " . mysqli_error($conn));
                    }
                    while ($feedback = mysqli_fetch_assoc($feedback_result)) {
                        echo "<tr>
                                <td>{$feedback['client_name']}</td>
                                <td>{$feedback['feedback']}</td>
                                <td>{$feedback['date']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php include "footer.php"; ?>
</body>
</html>
