<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
require('../uploads/config.php');

$id = $_GET['id'];
$sql = "DELETE FROM content WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: read.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
