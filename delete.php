<?php
// Include database connection
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch image path to delete the image file
    $query = "SELECT image FROM student WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $student = mysqli_fetch_assoc($result);
    $image_path = $student['image'];

    // Delete student record
    $delete_query = "DELETE FROM student WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        // Delete the image file
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        header('Location: index.php');
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
