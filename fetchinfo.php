<?php
require_once "pdo.php";

if (isset($_GET)){
 
  $stmt = $pdo->prepare("SELECT * FROM users where user_id = :id");
  $stmt->execute(array(":id" => $_GET['id']));
  $data = $stmt->fetch(PDO::FETCH_ASSOC);

  echo json_encode($data);
}
    
?>

