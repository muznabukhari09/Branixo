<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "project");

$id = $_POST['id'];
$name = $_POST['name'];
$cnic = $_POST['cnic'];
$email = $_POST['email'];
$program = $_POST['program'];
$phone = $_POST['phone'];

$sql = "UPDATE student SET 
            name='$name', 
            cnic='$cnic', 
            email='$email', 
            program='$program', 
            phone='$phone' 
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "<a href='admin_dashboard.php'>Go Back</a>";
} else {
    echo "Error updating student: " . $conn->error;
}

$conn->close();
?>
