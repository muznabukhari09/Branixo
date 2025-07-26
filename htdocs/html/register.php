<?php
$conn = new mysqli("localhost", "root", "", "project");

if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed.";
    exit;
}

$name = $_POST['name'];
$cnic = $_POST['cnic'];
$email = $_POST['email'];
$program = $_POST['program'];
$phone = $_POST['phone'];

// Optional: Check if email already exists
// $check = $conn->query("SELECT * FROM student WHERE email='$email'");
// if ($check->num_rows > 0) {
//     echo "Email already registered.";
//     exit;
// }

$sql = "INSERT INTO student (name, cnic, email, program, phone)
        VALUES ('$name', '$cnic', '$email', '$program', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "success"; // JS checks this word
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
