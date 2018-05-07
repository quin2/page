<?php session_start();
  if(!isset($_SESSION["auth"])){
      eheader("Location:http://localhost:8888/project/login.php", true, 301);
      die();
  }

  include 'scripts/common.php';

  $db = getDB();
  try{
    $stmt = $db->prepare("SELECT username, email, created FROM users WHERE id =:id");
    $stmt->execute(array(':id' => $_SESSION['user']));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (Exception $e) {
    return false;
  }
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Page - Profile</title>
    <link href="assets/style.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <div id="topBar">
      <a href="login.php" alt="go home" class="logotype">page alpha</a>
      <a href="newpost.php" alt="new post">+story</a>
      <a href="scripts/logout.php" alt="log out">logout!</a>
    </div>

    <div id = "mainSpace">
      <div class = "newPostCard">
        <h2 class="logotype">hello <?= $rows[0]['username'] ?></h2>

          <div class="formheader">
            Your email is:
          </div>
            <h4><?= $rows[0]['email'] ?></h4>
          <div class="formheader">
            You joined:
          </div>
            <h4><?= $rows[0]['created'] ?></h4>

          <div class="formheader">
            version: testflight &#x2708;
          </div>

          <div class="formheader">
            ui: futura free
          </div>
      </div>
    </div>

  </body>
</html>
