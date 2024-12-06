<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Extract database connection details

// Connect to the MySQL database
$conn = new mysqli('websitewit-566de4289f-wpdbserver.mysql.database.azure.com', 'yxfvhhuzwo', '123123rr!!', 'websitewit_566de4289f_database');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Set the charset to UTF-8
if (!$conn->set_charset("utf8")) {
    die("Error loading character set utf8: " . $conn->error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);

    // Insert data into the database
    $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
</head>
<body>
    <h1>Student Information Form</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
