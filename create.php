<?php
include 'connection/db_connect.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $class_id=$_POST['class_id'];
    $image=$_FILES['image']['name'];
    $target_dir="uploads/";
    $target_file=$target_dir . basename($image);
    $imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!empty($name) && in_array($imageFileType, ['jpg', 'png'])) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $query="INSERT INTO students (name, email, address, class_id, image) VALUES ('$name', '$email', '$address', '$class_id', '$image')";
            if ($conn->query($query)) {
                header("Location: index.php");
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Please fill out the form correctly.";
    }
}
$class_query="SELECT * FROM classes";
$classes=$conn->query($class_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Demo | Add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid w-100 my-3"></div>
    <div class="w-75 m-auto mid-section">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email Address" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Address</label>
                    <textarea class="form-control" rows="1" id="address" name="address" placeholder="Address"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Class</label>
                    <select name="class_id" class="form-control" required>
                        <option value="">Select a class</option>
                        <?php while ($class=$classes->fetch_assoc()) { ?>
                            <option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept=".jpg,.jpeg,.png">
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-dark w-100">Submit</button>
            </div>
        </form>
    </div>
    <footer class="bg-dark p-2 text-light text-center fixed-bottom">
        <p>copyright@mycrud</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>