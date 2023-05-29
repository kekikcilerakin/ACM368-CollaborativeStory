<?php
require_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $stories = "SELECT title, id FROM stories";
    $result = $conn->query($stories);
    echo "<div class ='btn loginToAdd' style =  'margin-top : 20px'  > <a style = 'text-decoration : none' href='index.php' >Back To Main Page</a> </div>";
    foreach ($result as $story) {
        if ($story['id'] === $id) {
            $storyTitle = $story['title'];
            echo " <br> <div class ='story-title-div'> ";
            echo $storyTitle . "<br> <br>";
            echo "</div>";

            $chapters = "SELECT chapterTitle, chapterText, userId, storyId FROM chapters";
            $result = $conn->query($chapters);
            echo "<div class = 'chapter-container'>";
            foreach ($result as $chapter) {
                if ($chapter['storyId'] === $id) {
                  
                    echo "<div class = 'chapter'>";
                    echo "<div class = 'chapter-title-div'> " . $chapter['chapterTitle'] . " </div> <br> <div class = 'chapter-text-div'> ";
                    echo $chapter['chapterText'] . "<br> </div>";
                    $chapterUserId = $chapter['userId'];

                    $users = "SELECT username, id FROM users";
                    $result = $conn->query($users);
                    
                    foreach ($result as $user) {
                        if ($user['id'] === $chapterUserId) {
                            echo "<div class = 'chapter-id-div'>";
                            echo $user['username'];
                            echo "</div>";
                        }
                    }
                    echo "</div>";
                   
                }
            }
            echo "</div>";
            echo "<br> <br> <br>";
            echo "<hr>";
        }
        
    }

    session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        ?>
        <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
  <style>
        body {
            font-family: 'Rubik', sans-serif;
            background-color: #222222;
            color : white;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #333333;
            color: #ffffff;
            border-radius :6px;
            
        }
        
        h2, h3, h4 {
            color: #ffffff;
        }
        
        form {
            margin-top: 20px;
        }
        
        label {
            font-weight: bold;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            resize: vertical;
        }
        
        .form-group {
            margin-top: 10px;
        }
        
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        
        a {
            color: #ffffff;
        }
        
        a:hover {
            color: #f8f9fa;
            text-decoration: none;
        }
        .chapter-text-div{
           border-radius: 10px;
           /* border : 1px solid darkgray; */
           margin:auto;
           padding : 10px;
           justify-content: center;
           width : 100%;
           padding : 5px;
           
           
           
        }
        .chapter-title-div{
            align-items: center;
            text-align: center;
            font-weight: bold;
            
        }
        .chapter-id-div{
            float : right;
            padding-right : 2%;
            
        }
        .chapter-container{
            
           width : 100%;
            
          
        }
        .chapter{
            align-items: center;
            background-color : #333;
            justify-content: center;
            margin: auto;
            width : 50%; 
            margin-bottom : 20px;
            padding-bottom : 25px;
            padding-top: 5px;
            border-radius : 10px;
            margin-top : 6px;
            
        }
        .story-title-div{
            text-align : center;
            font-weight: bold;
            font-size : 20px;
            
            
        }
        form { 
        margin: 0 auto; 
        width: 75%;
}

        
    </style>
        <form action="insertchapter.php" method="post">
            <p>
                <label>Chapter Title:</label>
                <br>
                <input type="text" name="chapter_title" id="chapterTitle" required>
            </p>

            <p>
                <label>Story:</label>
                <br>
                <textarea name="chapter_text" id="chapterText" rows="4" cols="50" required></textarea>
            </p>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit Chapter">
            </div>

            <input type="hidden" name="story_id" id="storyId" value="<?= $id ?>">
        </form>
        <?php
    } else {
        echo "<br><a href='login.php'>Login to Add a New Chapter</a>";
    }

    exit();
}
?>