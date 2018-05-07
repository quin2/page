<?php
  include 'common.php';

  $username = htmlentities($_POST['uname'], ENT_QUOTES);
  $email = htmlentities($_POST['email'], ENT_QUOTES);
  $password = $_POST["password"];

  //check to see if email is in database
  $db = getDB();

  try{
    $stmt = $db->prepare("SELECT username FROM users WHERE email =:email");
    $stmt->execute(array(':email' => $email));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (Exception $e) {
    return false;
  }
  if(count($rows) != 0){
    returnError();
  }

  //check to see if username is in database
  try{
    $stmt = $db->prepare("SELECT email FROM users WHERE username =:uname");
    $stmt->execute(array(':uname' => $username));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (Exception $e) {
    return false;
  }
  if(count($rows) != 0){
    returnError();
  }

  //hash+salt password
  $password = password_hash($password, PASSWORD_DEFAULT);

  //store new stuff into database! we're almost done! :D
  try{
    $stmt = $db->prepare("INSERT INTO users (username, password, email, attempts) VALUES (:user, :pass, :mail, 0)");
    $stmt->execute(array(':user' => $username, ':pass' => $password, ':mail' => $email));
  }
  catch (Exception $e) {
    returnError();
  }

  //now redirect user back to home!
  echo('success! ');
  echo('click <a href="../login.php" alt="login">here</a> to log in');

  //function to throw redirect back to login page if user with same username/pass exists
  //you will need to fix this before deployment
  function returnError(){
    header("Location: http://localhost:8888/project/login.php?newAccountFailed=true/", true, 301); /* Redirect browser */
    exit();
  }
?>
