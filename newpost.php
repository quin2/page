<?php session_start();
  if(!isset($_SESSION["auth"])){
      header("Location:http://localhost:8888/project/login.php", true, 301);
      die();
  }
?>

<!DOCTYPE HTML>
<html>
<head>
  <title>Page - New Post</title>
  <meta charset="utf-8" />
  <link href="assets/style.css" type="text/css" rel="stylesheet" />
  <script type="text/javascript" src="scripts/graphicsEngine.js"></script>
 <script type="text/javascript" src="scripts/postEngine.js"></script>
</head>
<body>


  <div id="topBar">
    <a href="home.php" alt="go home">page alpha</a>
    <a href="newpost.php" alt="make new story">+story</a>
    <a href="profile.php" alt="your profile">you</a>
  </div>

 <form id="newPostForm" method="post" action="scripts/processPost.php">
  <div id="mainSpace">
    <div class="newPostCard">
      <h2 class="logotype" id="theTitle">your story</h2>
        <input type=text id="sTitle" name"postTitle" maxlength="40" value="post title"/>
        <div>
          <label for="sTitle" id="sTitleLabel" hidden>make it a little longer...</label>
        </div>
  </div>
  <div id="bottomNavBar">
    <button class="retroButton" type="button" onclick="location.href='http://localhost:8888/project/home.php';">cancel</button>
    <button class="retroButton" id = "deleteButton" type="button">clear</button>
    <input type="submit" class="retroButton" id="post" value="post" disabled/>
  </div>
</form>
</body>


<div id="cardFiller" hidden>
  <h2 class="logotype">today</h2>
  <input class="postDate" type="hidden" name="cardDate[]" value="currentDate" />
  <label for="entryText" id="entryTextLabel">400 words left</label>
  <textarea form="newPostForm" name="postText[]" id="entryText" rows="4" cols="20" maxlength="750">
    write something!
  </textarea>

  <div>
    <label for="attachImage">add a picture next:</label>
  </div>
  <input type="file" name="pic[]" id="attachImage" accept="image/*">
</div>
</html>
