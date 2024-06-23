<?php
// Include database connection
include 'includes/db.php';

// Add a new class
if (isset($_POST['add_class'])) {
    $name = $_POST['name'];
    $created_at = date('Y-m-d H:i:s');
    $add_query = "INSERT INTO classes (name, created_at) VALUES ('$name', '$created_at')";
    if (mysqli_query($conn, $add_query)) {
        header('Location: classes.php');
        exit;
    } else {
        echo "Error adding class: " . mysqli_error($conn);
    }
}

// Edit a class
if (isset($_POST['edit_class'])) {
    $class_id = $_POST['class_id'];
    $name = $_POST['name'];
    $update_query = "UPDATE classes SET name='$name' WHERE class_id=$class_id";
    if (mysqli_query($conn, $update_query)) {
        header('Location: classes.php');
        exit;
    } else {
        echo "Error updating class: " . mysqli_error($conn);
    }
}

// Delete a class
if (isset($_GET['delete_class'])) {
    $class_id = $_GET['delete_class'];
    $delete_query = "DELETE FROM classes WHERE class_id=$class_id";
    if (mysqli_query($conn, $delete_query)) {
        header('Location: classes.php');
        exit;
    } else {
        echo "Error deleting class: " . mysqli_error($conn);
    }
}

// Fetch all classes
$query_classes = "SELECT * FROM classes";
$result_classes = mysqli_query($conn, $query_classes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Classes</h1>
        <h2>Add Class</h2>
        <form action="" method="POST">
            <label for="name">Class Name:</label>
            <input type="text" name="name" required>
            <button type="submit" name="add_class">Add Class</button>
        </form>
        <h2>All Classes</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($class = mysqli_fetch_assoc($result_classes)) { ?>
                <tr>
                    <td><?php echo $class['class_id']; ?></td>
                    <td><?php echo $class['name']; ?></td>
                    <td>
                        <form action="" method="POST" style="display:inline-block;">
                            <input type="hidden" name="class_id" value="<?php echo $class['class_id']; ?>">
                            <input type="text" name="name" value="<?php echo $class['name']; ?>" required>
                            <button type="submit" name="edit_class">Edit</button>
                        </form>
                        <a href="classes.php?delete_class=<?php echo $class['class_id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
