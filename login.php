<?php session_start();
if(isset($SESSION_["auth"])){
    echo 'already logged in!';
    die();
}
  include 'scripts/common.php';
  $maxLoginAttempts = 10;
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>Page - Login/Register</title>
    <meta charset="utf-8" />
    <link href="assets/style.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="scripts/login.js"></script>
  </head>
  <body>

    <div id="topBar">
      <a href="login.php" alt="go home" class="logotype">page alpha</a>
    </div>

    <div id="mainSpace">
      <div class="newPostCard">
        <h2 class="logotype">welcome</h2>
        <form method="post" action="verifylogin.php">
          <div class ="formheader">
            login:
          </div>

          <?php
            $buttonState = "enabled";

            if(isset($_GET['loginAttemptsExceeded'])){
              $attempts = $_GET['loginAttemptsExceeded'];
              echo('<div class="alert">Login Disabled, you have tried ' . $attempts. ' times</div>');
              $buttonState = "disabled";
            }

            if(isset($_GET['loginFailed'])){
              $attempts = $_GET['loginFailed'];
              echo('<div class="alert">Incorrect Username/Password, you have guessed ' . $attempts . ' times</div>');
            }
          ?>

          <label for="email">email address:</label>
          <input name="email" id="email" type="text" size="12" placeholder="@" maxlength="32"/>

          <label for="password">password:</label>
          <input name="password" id ="password" type="password" size="12" placeholder="******" maxlength="70"/>

          <input type="submit" value="login" class="retroButton" <?=$buttonState?>/>
        </form>

        <form method="post" action="scripts/newuser.php">
          <div class="formheader">
          new account:
          </div>

          <?php
            if(isset($_GET['newAccountFailed'])){
              echo ('<div class="alert">That username/email is already in use!</div>');
            }
          ?>

          <label for="email_newuser">email address:</label>
          <input name="email" id="email_newuser" type="text" size="12" placeholder="@" maxlength="32"/>

          <label for="password_newuser">password:</label>
          <input name="password" id ="password_newuser" type="password" size="12" placeholder="******" maxlength="70"/>

          <label for="password_newuser_reenter">retype password:</label>
          <input id ="password_newuser_reenter" type="password" size="12" placeholder="******" maxlength="70"/>

          <label for="email">username:</label>
          <input name="uname" id="uname" type="text" size="12" placeholder="you" maxlength="16"/>

          <input type="submit" value="create new account" id ="submitButton" class= "retroButton" disabled/>
        </form>
      </div>
    </div>
  </body>
</html>
