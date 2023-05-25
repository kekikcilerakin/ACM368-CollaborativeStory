<!DOCTYPE html>
<html>

<head>
    <style>
        .story-container {
            display: flex;
            flex-wrap: wrap;
        }

        .story {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            height: 300px;
        }

        .storyImage {
            width: 144px;
            height: 225px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    require_once "connection.php";

    echo $_SESSION["username"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["id"] = null;
        $_SESSION["username"] = null;
        $_SESSION["loggedin"] = false;
        header("location: index.php");
    }

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

        ?>
        <h2>Add Story</h2>
        <form method="post" action="insertstory.php">
            <label for="title">Story Title:</label>
            <input type="text" name="story_title" required><br><br>
            <label for="title">Story Image:</label>
            <input type="text" name="story_image" required><br><br>
            <input type="submit" value="Create Story">

        </form>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="submit" value="Log Out">
        </form>
        <hr>
        <?php
    } else {
        echo '<a href="login.php">Login to Add a New Story</a>';
    }

    echo '<h2>Stories</h2>';
    echo '<div class="story-container">';

    $storiesQuery = "SELECT title, id, imageURL, userId FROM stories";
    $result = $conn->query($storiesQuery);

    if ($result->num_rows > 0) {
        foreach ($result as $story) {
            echo "<div class='story'>";
            echo "<a href='showstory.php?id={$story['id']}'><img class='storyImage' src='{$story['imageURL']}'> </a>";
            echo "<br>";
            echo "<a href='showstory.php?id={$story['id']}'><h3>{$story['title']}</h3></a>";

            $username = "SELECT username, id FROM users";
            $result = $conn->query($username);

            foreach ($result as $username) {
                if ($username['id'] === $story['userId']) {
                    echo "Author: " . $username['username'];

                }
            }

            echo '</div>';
        }
    }

    echo '</div>';
    ?>
</body>

</html>