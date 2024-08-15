<?php
include 'connection/db_connect.php';
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $image_query = "SELECT image FROM students WHERE id = $id";
    $image_result = $conn->query($image_query);
    $image = $image_result->fetch_assoc();
    if (file_exists("uploads/" . $image['image'])) {
        unlink("uploads/" . $image['image']);
    }
    $query = "DELETE FROM students WHERE id = $id";
    if ($conn->query($query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
