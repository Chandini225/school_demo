<?php
include 'includes/db.php';

// Fetch all students with class names using a JOIN query
$query = "
    SELECT s.id, s.name, s.email, s.address, s.created_at, s.image, c.name as class_name
    FROM student s
    LEFT JOIN classes c ON s.class_id = c.class_id
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - School Demo</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Include Bootstrap or any other CSS framework here if preferred -->
</head>
<body>
    <div class="container">
        <h1>Students</h1>
        <a href="create.php" class="btn btn-primary">Add Student</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Creation Date</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo $row['class_name']; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" alt="Thumbnail" class="thumbnail"></td>
                    <td>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-info">View</a>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
