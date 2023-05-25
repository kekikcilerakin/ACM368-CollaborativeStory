<?php
require_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $stories = "SELECT title, id FROM stories";
    $result = $conn->query($stories);

    foreach ($result as $story) {
        if ($story['id'] === $id) {
            $storyTitle = $story['title'];

            echo $storyTitle . "<br>";

            $chapters = "SELECT chapterTitle, chapterText, userId, storyId FROM chapters";
            $result = $conn->query($chapters);

            foreach ($result as $chapter) {
                if ($chapter['storyId'] === $id) {

                    echo "<br><br>" . $chapter['chapterTitle'] . "<br>";
                    echo $chapter['chapterText'] . "<br>";
                    $chapterUserId = $chapter['userId'];

                    $users = "SELECT username, id FROM users";
                    $result = $conn->query($users);

                    foreach ($result as $user) {
                        if ($user['id'] === $chapterUserId) {
                            echo $user['username'];
                        }
                    }
                }
            }
        }
    }

    session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

        echo '<form action="insertchapter.php" method="post">
        <label for="firstName">chapterTitle:</label>
               <input type="text" name="chapter_title" id="chapterTitle" required>
            </p>
 
             
<p>
               <label for="lastName">chapterText:</label>
               <input type="text" name="chapter_text" id="chapterText" required>
            </p>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit Chapter">
        </div>

        
        <input type="hidden" name="story_id" id="storyId" value="'.$id.'">

    </form>';
    } else {
        echo "<br><a href='login.php'>Login to Add a New Chapter</a>";
    }
    
    exit();
}
?>