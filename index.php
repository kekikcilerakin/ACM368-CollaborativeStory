<!DOCTYPE html>
<html>
<link rel="preconnect" href="https://fonts.googleapis.com%22%3E/
<link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">

<head>
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            background: #222222;
            color: white;
        }

        .story-container {
            display: flex;
            flex-wrap: wrap;


        }

        hr {
            margin: auto;
            width: 90%;

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

        .second-addstory-div {
            width: 20%;
            float: right;
            padding-bottom: 20px;
            border: 1px solid gray;
            position: -webkit-sticky;
            /* Safari & IE */
            position: sticky;
            top: 0;

            align-items: center;
            text-align: center;

        }

        .btn {
            display: block;
            width: 50%;
            padding: 5px;
            background-color: #007bff;
            margin: auto;
            margin-bottom: 8px;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }

        .logout {
            background: red;
        }

        .loginToAdd {
            width: 25%;
        }

        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    require_once "connection.php";

    //logout start
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["id"] = null;
        $_SESSION["username"] = null;
        $_SESSION["loggedin"] = false;
        header("location: index.php");
    }
    //logout end

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

        ?>
        <div class="second-addstory-div">

            <?php echo '<h2>' . $_SESSION["username"] . '</h2>'; ?><br>
            <hr><br><br><br><br>
            <h2>Add Story</h2>

            <form method="post" action="insertstory.php">
                <label for="title">Story Title:&nbsp;&nbsp;&nbsp; </label>
                <input type="text" name="story_title" required><br><br>
                <label for="title">Story Image:</label>
                <input type="text" name="story_image" required><br><br><br>
                <input class="btn" type="submit" value="Create Story"><br><br><br><br><br><br><br><br>
                <hr><br><br>

            </form>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input class="btn logout" type="submit" value="Log Out">
            </form>



        </div>
        <?php
    } else {
        echo "<div class ='btn loginToAdd' style = 'text-align : center; margin-top : 20px'  > <a href='login.php' >Login to Add a New Story</a> </div>";
    }

    echo '<h2 style = "text-align : center">Stories</h2>';
    echo '<div class="story-container">';

    //get stories from database start
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
    //get stories from database end

    echo '</div>';
    ?>
</body>

</html>