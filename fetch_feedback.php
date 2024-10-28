<?php
$conn = new mysqli("localhost", "root", "", "multidoc");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, rating, comments FROM feedback";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='feedback_item'>";
        echo "<h3>" . htmlspecialchars($row["name"]) . "</h3>";
        echo "<div class='star-rating'>" . str_repeat('★', $row["rating"]) . str_repeat('☆', 5 - $row["rating"]) . "</div>";
        echo "<p class='rating'>Rating: " . htmlspecialchars($row["rating"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["comments"]) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No feedback available.</p>";
}

$stmt->close();
$conn->close();
?>
