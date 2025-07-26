<?php
session_start();
if (!isset($_SESSION['admin'])) {
    exit("Unauthorized access.");
}

if (isset($_GET['id'])) {
    $conn = new mysqli("localhost", "root", "", "project");
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM student WHERE id=$id");
    echo "Deleted";
} else {
    echo "Invalid request.";
}
?>
