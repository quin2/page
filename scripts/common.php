

<?php
function getDB(){
  $servername = "localhost";
  $username = "accManager";
  $password = "W4i6xJZpVUf183dY";
  $database = "page";
  $dbport = 8889;

  try {
  $db = new PDO("mysql:host=$servername;dbname=$database;charset=utf8;port=$dbport", $username, $password);
  }
  catch(PDOException $e) {
  echo $e->getMessage();
  }
  return $db;
}

?>
