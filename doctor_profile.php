<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profiles</title>
    <style>
        .doctor_item {
    border-bottom: 1px solid #ddd;
    padding: 15px 0;
    margin-bottom: 20px; /* Add space between profiles */
}

.doctor_item:last-child {
    border-bottom: none;
    margin-bottom: 0; /* Ensure the last item does not have extra margin */
}

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .doctor_container {
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .doctor_item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
            margin-bottom: 20px; /* Add space between profiles */
        }
        .doctor_item:last-child {
            border-bottom: none;
            margin-bottom: 0; /* Ensure the last item does not have extra margin */
        }
        .doctor_item h3 {
            margin: 0;
            font-size: 1.5em;
            color: #2c3e50;
        }
        .doctor_item img {
            max-width: 150px;
            border-radius: 8px;
            margin-right: 15px;
        }
        .doctor_item p {
            margin: 5px 0;
            font-size: 1em;
        }
        .doctor_item p.specialization, .doctor_item p.availability, .doctor_item p.fee {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="doctor_container">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "multidoc") or die(mysqli_connect_error());

        $sql = "SELECT doctor_id, image, specialization, profile, availability, mony, doctor_name FROM doctors WHERE 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='doctor_item'>";
                echo "<img src='" . htmlspecialchars($row["image"]) . "' alt='Doctor Image'>";
                echo "<h3>" . htmlspecialchars($row["doctor_name"]) . "</h3>";
                echo "<p class='specialization'>Specialization: " . htmlspecialchars($row["specialization"]) . "</p>";
                echo "<p class='profile'>Profile: " . htmlspecialchars($row["profile"]) . "</p>";
                echo "<p class='availability'>Availability: " . htmlspecialchars($row["availability"]) . "</p>";
                echo "<p class='fee'>Consultation Fee: " . htmlspecialchars($row["mony"]) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No doctors available.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
