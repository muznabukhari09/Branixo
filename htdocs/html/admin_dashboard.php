<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "project");
$result = $conn->query("SELECT * FROM student");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - View Students</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color:rgb(59, 236, 74);
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
            background-color:rgb(22, 144, 175);
            border-radius: 5px;
        }

        header .right a:hover {
            background-color: #c0392b;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
        }

        #searchBar {
            display: block;
            margin: 20px auto;
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color:rgb(61, 158, 214);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #eaf2f8;
        }

        .action-icons a {
            margin: 0 5px;
            text-decoration: none;
            font-size: 18px;
            cursor: pointer;
        }

        .action-icons .edit {
            color: #2980b9;
        }

        .action-icons .delete {
            color: #e74c3c;
        }

        .action-icons a:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>

<header>
    <div class="left">
        <img src="images.jpeg" alt="Admin Profile">
        <span><strong>Admin Portal</strong></span>
    </div>
    <div class="right">
        <a href="adminlogin.html">Logout</a>
    </div>
</header>

<h2>Registered Students</h2>

<input type="text" id="searchBar" placeholder="Search by name, email, CNIC...">

<table id="studentsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>CNIC</th>
            <th>Email</th>
            <th>Program</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['cnic']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['program']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td class="action-icons">
                <a href="edit_student.php?id=<?= $row['id'] ?>" class="edit" title="Edit">✏️</a>
                <a href="#" onclick="confirmDelete(<?= $row['id'] ?>)" class="delete" title="Delete">🗑️</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This student will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX call to delete_student.php
            fetch(`delete_student.php?id=${id}`)
                .then(response => response.text())
                .then(data => {
                    Swal.fire(
                        'Deleted!',
                        'Student has been deleted.',
                        'success'
                    ).then(() => {
                        location.reload(); // Reload the page after alert
                    });
                })
                .catch(error => {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                    console.error(error);
                });
        }
    });
}
</script>


</body>
</html>
