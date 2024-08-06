<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
include('../includes/header.php');
?>
<div class="container mt-5">
    <h2>Create Content</h2>
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" id="body" name="body" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<?php include('../includes/footer.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../uploads/config.php');
    $title = $_POST['title'];
    $body = $_POST['body'];
    $user_id = $_SESSION['userid'];

    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);

    $sql = "INSERT INTO content (title, body, image, user_id) VALUES ('$title', '$body', '$image', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        header('Location: read.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
