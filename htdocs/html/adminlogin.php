<?php
session_start();
$conn = new mysqli("localhost", "root", "", "project");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if ($password == $row['password']) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    } else {
        echo "Wrong password!";
    }
} else {
    echo "Admin not found!";
}
?>
