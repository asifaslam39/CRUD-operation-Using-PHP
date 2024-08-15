<?php
include 'connection/db_connect.php';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['add_class'])) {
    $class_name=$_POST['name'];
    if (!empty($class_name)) {
        $query="INSERT INTO classes (name, created_at) VALUES ('$class_name', NOW())";
        if ($conn->query($query)) {
            header("Location: classes.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
if (isset($_GET['delete_id'])) {
    $delete_id=$_GET['delete_id'];
    $query="DELETE FROM classes WHERE class_id = '$delete_id'";
    if ($conn->query($query)) {
        header("Location: classes.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
$query="SELECT * FROM classes";
$classes=$conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <h2>Manage Classes</h2>
        <form action="classes.php" method="POST" class="mb-5">
            <div class="mb-3">
                <label for="name" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter class name" required>
            </div>
            <button type="submit" name="add_class" class="btn btn-dark">Add Class</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Class Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($classes->num_rows > 0) : ?>
                    <?php while ($class = $classes->fetch_assoc()) : ?>
                        <tr>
                            <th scope="row"><?php echo $class['class_id']; ?></th>
                            <td><?php echo $class['name']; ?></td>
                            <td><?php echo $class['created_at']; ?></td>
                            <td>
                                <a href="edit_class.php?id=<?php echo $class['class_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="classes.php?delete_id=<?php echo $class['class_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this class?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">No classes found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer class="bg-dark p-2 text-light text-center">
        <p>copyright@mycrud</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>