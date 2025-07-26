<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "project");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM student WHERE id=$id");
    $row = $result->fetch_assoc();
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color:rgb(160, 255, 97);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        header .left img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        header .right a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
                background-color:rgb(90, 255, 98);
            border-radius: 5px;
        }

        header .right a:hover {
            background-color: #c0392b;
        }

        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px);
        }

        .form-container {
            width: 400px;
            background: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color:rgb(90, 255, 98);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            text-decoration: none;
            color: #555;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <div class="left">
        <img src="images.jpeg" alt="Admin Profile">
        <span><strong>Admin Panel</strong></span>
    </div>
    <div class="right">
        <a href="logout.php">Logout</a>
    </div>
</header>

<div class="form-wrapper">
    <div class="form-container">
        <h2>Edit Student</h2>
        <form action="update_student.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

            <label for="name">Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>

            <label for="cnic">CNIC</label>
            <input type="text" name="cnic" value="<?= htmlspecialchars($row['cnic']) ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>

            <label for="program">Program</label>
            <input type="text" name="program" value="<?= htmlspecialchars($row['program']) ?>" required>

            <label for="phone">Phone</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" required>

            <input type="submit" value="Update">
        </form>

        <div class="back-link">
            <a href="admin_dashboard.php">← Back</a>
        </div>
    </div>
</div>

</body>
</html>
