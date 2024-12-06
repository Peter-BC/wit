<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Extract database connection details

// Connect to the MySQL database
//$conn = new mysqli('mydata.mysql.database.azure.com', 'localdb', '123123rr!!', 'localdb');
$conn = new mysqli('mydata.mysql.database.azure.com', 'localdb', '123123rr!!', 'localdb', 3306, MYSQLI_CLIENT_SSL);

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
		echo "<script>location.reload()</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
</head>
<body>
    <h1>Student register Form</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <button type="submit">Submit</button>
    </form>
	<h1>Student Information </h1>
	<?php
$sql = "SELECT name, email FROM students";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['name'] . "</td>
                <td>" . $row['email'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}	
// Close the connection
$conn->close();
?>
</body>
</html>
