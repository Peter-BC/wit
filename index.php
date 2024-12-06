<?php
// Parse the connection string from the environment variable
$conn_str = getenv('MYSQLCONNSTR_localdb');
if (!$conn_str) {
    die("Environment variable 'MYSQLCONNSTR_localdb' not found.");
}

// Convert the connection string into an associative array
parse_str(str_replace(';', '&', $conn_str), $db_params);

// Extract database connection details

// Connect to the MySQL database
$conn = new mysqli('mydata.mysql.database.azure.com', 'localdb', '123123rr!!', 'localdb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
