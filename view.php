<?php
include 'includes/db.php';

// Fetch student details with class name using a JOIN query
$id = $_GET['id'];
$query = "
    SELECT s.id, s.name, s.email, s.address, s.created_at, s.image, c.name as class_name
    FROM student s
    LEFT JOIN classes c ON s.class_id = c.class_id
    WHERE s.id = $id
";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student - School Demo</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Include Bootstrap or any other CSS framework here if preferred -->
</head>
<body>
    <div class="container">
        <h1>View Student</h1>
        <table class="table">
            <tr>
                <th>Name</th>
                <td><?php echo $row['name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?
