<?php
// Include database connection
include 'includes/db.php';

// Fetch student details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "
        SELECT s.*, c.name as class_name
        FROM student s
        LEFT JOIN classes c ON s.class_id = c.class_id
        WHERE s.id = $id
    ";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
}

// Fetch all classes for the dropdown
$query_classes = "SELECT * FROM classes";
$result_classes = mysqli_query($conn, $query_classes);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];
    $created_datetime = date('Y-m-d H:i:s');

    // Image upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['image']['type'], $allowed_types)) {
            $image_path = 'uploads/' . uniqid() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        } else {
            echo "Invalid image format. Only JPG and PNG are allowed.";
            exit;
        }
    } else {
        $image_path = $student['image'];
    }

    $update_query = "
        UPDATE student
        SET name='$name', email='$email', address='$address', class_id='$class_id', image='$image_path', created_datetime='$created_datetime'
        WHERE id=$id
    ";

    if (mysqli_query($conn, $update_query)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
            <br>
            <label for="address">Address:</label>
            <textarea name="address" required><?php echo $student['address']; ?></textarea>
            <br>
            <label for="class_id">Class:</label>
            <select name="class_id" required>
                <?php while ($class = mysqli_fetch_assoc($result_classes)) { ?>
                    <option value="<?php echo $class['class_id']; ?>" <?php if ($class['class_id'] == $student['class_id']) echo 'selected'; ?>>
                        <?php echo $class['name']; ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="image">Image:</label>
            <input type="file" name="image">
            <br>
            <button type="submit">Update Student</button>
        </form>
    </div>
</body>
</html>
