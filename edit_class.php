<?php
include 'connection/db_connect.php';
if (isset($_GET['id'])) {
    $class_id=$_GET['id'];
    $class_query="SELECT * FROM classes WHERE class_id=$class_id";
    $class_result=$conn->query($class_query);
    if ($class_result->num_rows > 0) {
        $class=$class_result->fetch_assoc();
    } else {
        echo "Class not found.";
        exit;
    }
} else {
    echo "No class ID provided.";
    exit;
}
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $name=$_POST['name'];
    $update_query="UPDATE classes SET name='$name' WHERE class_id=$class_id";
    if ($conn->query($update_query)) {
        header("Location: classes.php");
    } else {
        echo "Error updating class: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container my-5">
        <h2>Edit Class</h2>
        <form action="edit_class.php?id=<?php echo $class_id; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $class['name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-dark">Update Class</button>
        </form>
    </div>
    <footer class="bg-dark p-2 text-light text-center fixed-bottom">
        <p>copyright@mycrud</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
