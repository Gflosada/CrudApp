<?php include('../includes/header.php'); ?>
<div class="container mt-5">
    <h2>Content List</h2>
    <?php
    require('../uploads/config.php');
    $sql = "SELECT * FROM content";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $row['title'] . "</h5>";
            echo "<p class='card-text'>" . $row['body'] . "</p>";
            if ($row['image']) {
                echo "<img src='../uploads/" . $row['image'] . "' class='img-fluid' alt='Image'>";
            }
            echo "<a href='update.php?id=" . $row['id'] . "' class='btn btn-warning mr-2'>Edit</a>";
            echo "<a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No content found.";
    }
    ?>
</div>
<?php include('../includes/footer.php'); ?>
