<?php
    require_once "connection.php";
    session_start();

    $storyTitle = $_REQUEST['story_title'];
    $userId = $_SESSION['id'];

    $sql = "INSERT INTO stories (title, userId) VALUES ('$storyTitle', '$userId')";

    if (mysqli_query($conn, $sql)) {
        echo "Records added successfully.";
        echo $storyTitle;
        echo $userId;
    } else {
        echo $storyId;
        echo $userId;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    header("Location: index.php");
    exit();
?>