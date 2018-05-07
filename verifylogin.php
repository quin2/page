<?php include 'scripts/common.php';

  $maxLoginAttempts = 10;

  //get the necesary stuff, clear out malicious html
  $email = htmlentities($_POST['email'], ENT_QUOTES);
  $password = htmlentities($_POST['password'], ENT_QUOTES);

  //pull from $database
  $db = getDB();

  try{
    $stmt = $db->prepare("SELECT password, id FROM users WHERE email =:email");
    $stmt->execute(array(':email' => $email));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  catch (Exception $e) {
    return false;
  }

  //compre, reject if it doesnt miss
  if(password_verify($password, $rows[0]["password"])){
    //zero out login attempts
    try{
      $stmt = $db->prepare("UPDATE users SET attempts = 0 WHERE email =:email");
      $stmt->execute(array(':email' => $email));
    }
    catch (Exception $e) {
      return false;
    }

    //start secure session
    session_start();
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $rows[0]["id"]; //use id instead of username to save compute time

    //send to home!
    header("Location:http://localhost:8888/project/home.php", true, 301); //try 302 or 303?
    exit();
  }
  else{
    //update guess # on DD
    try{
      $stmt = $db->prepare("SELECT attempts FROM users WHERE email =:email");
      $stmt->execute(array(':email' => $email));
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (Exception $e) {
      return false;
    }

    $newAttempts = $rows[0]["attempts"] + 1;
    echo($newAttempts);

    //max login attempts has been exceeded!
    if($newAttempts >= $maxLoginAttempts){
      header("Location:http://localhost:8888/project/login.php?loginAttemptsExceeded=$newAttempts", true, 301);
      die();
    }

    //otherwise update thos login attempts fools
    try{
      $stmt = $db->prepare("UPDATE users SET attempts =:tries WHERE email =:email");
      $stmt->execute(array(':email' => $email, ':tries' => $newAttempts));
    }
    catch (Exception $e) {
      return false;
    }

    //send error back to login page!
  header("Location:http://localhost:8888/project/login.php?loginFailed=".$newAttempts, true, 301);
    die();

  }

?>
