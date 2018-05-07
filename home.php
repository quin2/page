<?php session_start();
if(!isset($_SESSION["auth"])){
  header("Location:http://localhost:8888/project/login.php", true, 301);
  die();
}

?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Page - Home</title>
    <link href="assets/style.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="scripts/graphicsEngine.js"></script>
    <script type="text/javascript" src="scripts/postLoader.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
  </head>
  <body>
    <div id="topBar">
      <a href="home.php" alt="go home" class="logotype">page alpha</a>
      <a href="newpost.php" alt="new post">+story</a>
      <a href="profile.php" alt="profile">you</a>
    </div>

    <div id = "mainSpace">
      <div class = "newPostCard">
        <div id="titlePreviewFiller">
          <div class="titlePreview">
            <div class="storyTitle">
              title
            </div>
            <div class="userCreated">
              user
            </div>
          </div>
        </div>

      </div>
    </div>

  </body>


  <div id="cardFiller" hidden>
    <div id="titlePreviewFiller">
      <div href="" class="titlePreview">
        <div class="storyTitle">
          title
        </div>
        <div class="userCreated">
          user
        </div>
      </div>
    </div>
  </div>

</html>
