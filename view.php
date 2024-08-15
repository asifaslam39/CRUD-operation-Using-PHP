<?php
include 'connection/db_connect.php';
$id=$_GET['id'];
$query="
    SELECT students.name, students.email, students.address, students.created_at, students.image, classes.name AS class_name 
    FROM students
    JOIN classes ON students.class_id = classes.class_id 
    WHERE students.id = $id
";
$result=$conn->query($query);
$student=$result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Student</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
        <?php include 'header.php'; ?>

    <div class="container-fluid my-3">
        <h5 class="bg-dark text-light text-center py-2" style="border-radius: 4px;">Details of <?php echo $student['name']; ?> </h5>
        <div class="row">
            <div class="col-md-6">
                <img src="uploads/<?php echo $student['image']; ?>" width="65%" height="350px">
            </div>
            <div class="col-md-6">
                <table class="table table-borderd">
                    <tr>
                        <th>Name</th>
                        <td> <?php echo $student['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td> <?php echo $student['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $student['address']; ?></td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td><?php echo $student['class_name']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th>Created_at</th>
                        <td><?php echo $student['created_at']; ?></p>
                        </td>
                    </tr>

                </table>


            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>