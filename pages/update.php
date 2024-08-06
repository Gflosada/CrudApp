<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
include('../includes/header.php');
require('../uploads/config.php');

$id = $_GET['id'];
$sql = "SELECT * FROM content WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<div class="container mt-5">
    <h2>Update Content</h2>
    <form action="update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $row['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" id="body" name="body" required><?php echo $row['body']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            <?php if ($row['image']) { ?>
                <img src="../uploads/<?php echo $row['image']; ?>" class="img-fluid mt-3" alt="Image">
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php include('../includes/footer.php'); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $image = $_FILES['image']['name'];
    if ($image) {
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE content SET title='$title', body='$body', image='$image' WHERE id='$id'";
    } else {
        $sql = "UPDATE content SET title='$title', body='$body' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: read.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
