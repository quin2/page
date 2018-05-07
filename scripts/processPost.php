<?php session_start();
if(!isset($_SESSION["auth"])){
    header("Location:http://localhost:8888/project/login.php", true, 301);
    die();
}

include 'common.php';
//check bounds for title, then append to DB in order to get post key
$postTitle = htmlentities($_POST['postTitle'], ENT_QUOTES);
if(strlen($postTitle) > 40 || strlen($postTitle) < 3){
  echo('title is invalid');
  exit;
}

$db = getDB();
//user not set properly?
$user = $_SESSION['user'];

try{
  $stmt = $db->prepare("INSERT INTO collections (title, author_id) VALUES (:title, :user)");
  $stmt->execute(array(':title' => $postTitle, ':user' => $user));
  $collectionID = $db->lastInsertID();
}
catch (Exception $e) {
  echo('database failed!');
}

//now scan/post every single card ever
$allDates = $_POST['cardDate'];
$allPostText = $_POST['postText'];

for($i=1; $i<count($allDates) - 1; $i++){
  $postText = htmlentities($allPostText[$i], ENT_QUOTES);
  $date = htmlentities($allDates[$i], ENT_QUOTES);
  //get filepath!!!
  $fileName = '';
  echo($_FILES['pic']['tmp_name'][$i]);
  if(is_uploaded_file($_FILES['pic']['tmp_name'][$i])){
    $fileName = uploadFile($i);
  }

  //post that shiii with PDO (reuse i)
  try{
    $stmt = $db->prepare("INSERT INTO cards (collection, headline, body, image_address, of_number) VALUES (:collection, :head, :body, :image, :num)");
    $stmt->execute(array(':collection' => $collectionID, ':head' => $date, ':body' => $postText, ':image' => $fileName, ':num' => $i));
  }
  catch (Exception $e) {
    echo('card posting failed -_-');
  }
}

function uploadFile($i){
  $UPLOAD_DIR = "../uploads/";
  //check if file is under limit
  if($_FILES['pic']['size'][$i] > 3145728){
    echo('file too large');
    exit();
  }
  //check if file is real
  $type = $ext = strtolower(end((explode(".", $_FILES['pic']['name'][$i]))));
  if($type != 'jpg' && $type != 'png' && $type != 'jpeg'){
    echo('file type not supported: '.$type);
    exit();
  }
  //move that shit & tag with shit
  $fileName = uniqid('postImg', true) . '.' . $type;
  $TARGET_DIR = $UPLOAD_DIR . $fileName;
  if(move_uploaded_file($_FILES['pic']['tmp_name'][$i], $TARGET_DIR)){
    return $fileName;
  }
  echo('upload failed :(');
  return;
}

header("Location:http://localhost:8888/project/home.php", true, 301);
exit();
?>
