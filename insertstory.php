<?php
require_once "connection.php";
session_start();

$storyTitle = $_REQUEST['story_title'];
$storyImage = $_REQUEST['story_image'];
$userId = $_SESSION['id'];

$sql = "INSERT INTO stories (title, userId, imageURL) VALUES ('$storyTitle', '$userId', '$storyImage')";

if (mysqli_query($conn, $sql)) {
    echo "Records added successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
header("Location: index.php");
exit();
?>