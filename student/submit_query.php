<?php
session_start(); // Start the session

// Database connection
$servername = "localhost"; // your server name
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "mess_management"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the input data from the form
$regnumber = $_POST['regnumber'];
$student_name = $_POST['name'];
$query_area = $_POST['queryArea'];
$query_text = $_POST['queryDescription'];

// Check if regnumber exists in the student_approved table
$checkRegNum = $conn->prepare("SELECT * FROM student_approved WHERE regnumber = ?");
$checkRegNum->bind_param("s", $regnumber);
$checkRegNum->execute();
$result = $checkRegNum->get_result();

if ($result->num_rows > 0) {
    // regnumber exists, proceed to insert the query
    $stmt = $conn->prepare("INSERT INTO queries (regnumber, student_name, query_area, query_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $regnumber, $student_name, $query_area, $query_text);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Thank you! Your query was submitted successfully"; // Set success message
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error; // Set error message
    }

    $stmt->close();
} else {
    // regnumber does not exist
    $_SESSION['message'] = "The register number is not valid."; // Set invalid number message
}

$checkRegNum->close();
$conn->close();

// Redirect back to the form page
header("Location: raise_queries.php");
exit();
?>
