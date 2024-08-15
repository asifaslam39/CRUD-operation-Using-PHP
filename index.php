<?php
include 'connection/db_connect.php';
$sql="SELECT students.id, students.name, students.email, students.created_at, classes.name AS class_name, students.image
        FROM students
        JOIN classes ON students.class_id = classes.class_id";
$result=$conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Demo | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid my-3">
        <div class="mid-section">
            <h5 class="bg-dark text-light text-center py-2" style="border-radius: 4px;">Students Details</h5>
            <table class="table table-borderd table-hover table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th>Actions</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['class_name']; ?></td>
                        <td><img src="uploads/<?php echo $row['image']; ?>" width="50" height="50"></td>
                        <td><a href="edit.php?id=<?php echo $row['id']; ?>"><span class="material-symbols-outlined text-dark">
                                    edit
                                </span></a></td>
                        <td><a href="delete.php?id=<?php echo $row['id']; ?>"><span class="material-symbols-outlined text-dark">
                                    delete
                                </span></a></td>
                        <td><a href="view.php?id=<?php echo $row['id']; ?>"><span class="material-symbols-outlined text-dark">preview</span></a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <footer class="bg-dark p-2 text-light text-center fixed-bottom">
        <p>copyright@mycrud</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>