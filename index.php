<!DOCTYPE html>
<html>
<head>
    <style>
        .story-container {
            display: flex;
            flex-wrap: wrap;
        }

        .story {
            flex-basis: 10%;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    require_once "connection.php";

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { 
        echo '
        <h2>Add Story</h2>
        <form method="post" action="insertstory.php">
            <label for="title">Story Title:</label>
            <input type="text" name="story_title" required><br><br>
            <input type="submit" value="Create Story">
        </form>
        <br>
        <hr><hr>';
    } else {
        echo '<br><a href="login.php">Login to Add a New Story</a>';
    }

    echo '<h2>Stories</h2><div class="story-container">';

    $storiesQuery = "SELECT title, id FROM stories";
    $result = $conn->query($storiesQuery);

    if ($result->num_rows > 0) {
        foreach ($result as $story) {
            echo '<div class="story">';
            echo "<h3>{$story['title']}</h3>";
            echo "<a href='showstory.php?id={$story['id']}'>Show Story</a>";
            echo '</div>';
        }
    }
    
    echo '</div>';
    ?>
</body>
</html>
