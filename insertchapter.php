<?php
    require_once "connection.php";
    session_start();

    $chapterTitle = $_REQUEST['chapter_title'];
    $chapterText = $_REQUEST['chapter_text'];
    $storyId = $_REQUEST['story_id'];
    $userId = $_SESSION['id'];

    $sql = "INSERT INTO chapters (userId, chapterTitle, chapterText, storyId) VALUES ('$userId', '$chapterTitle', '$chapterText', '$storyId')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Records added successfully.";
        echo $storyId;
    } else {
        echo $storyId;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    header("Location: showstory.php?id=$storyId");
    exit();
?>