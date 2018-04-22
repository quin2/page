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
  </head>
  <body>
    <div id="topBar">
      <a href="home.php" alt="go home">page alpha</a>
      <a href="newpost.php" alt="new post">+story</a>
      <a href="profile.php" alt="profile">profile</a>
    </div>

    <div id = "mainSpace">
      <div class = "newPostCard">


      </div>
    </div>

  </body>
</html>
