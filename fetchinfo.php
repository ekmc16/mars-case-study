<?php
require_once "pdo.php";

if (isset($_GET)){
 if(isset($_GET_['martian_id'])){
  $stmt = $pdo->prepare("SELECT * FROM martian where martian_id = :id");
  $stmt->execute(array(":id" => $_GET['martian_id']));
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
 }
  echo json_encode($data);
}
    
?>

