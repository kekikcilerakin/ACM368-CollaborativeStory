<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color : white;
            background : #222222;

        }

        .header {
            background-color: #222222;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background : #333333;
        }

        .story {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .story-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }

        .story-title {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .story-author {
            margin-top: 5px;
            color: #666;
        }

        .add-story-form {
            margin-top: 20px;
        }

        .add-story-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .add-story-form input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .add-story-form input[type="submit"] {
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-btn {
            margin-top: 20px;
        }

        .login-link {
            margin-top: 20px;
            text-align: center;
            color: #4CAF50;
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
