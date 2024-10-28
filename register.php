<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register_code.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required><br>

        <label for="user-type">User Type:</label>
        <select id="user-type" name="user-type" required>
            <option value="client">Client</option>
            <option value="doctor">Doctor</option>
        </select><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
