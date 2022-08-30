<?php
require_once "pdo.php";

if (isset($_GET)){
 if(isset($_GET['martian_id'])){
  $stmt = $pdo->prepare("SELECT * FROM martian where martian_id = :id");
  $stmt->execute(array(":id" => $_GET['martian_id']));
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
 }
 elseif(isset($_GET['base_id'])){
  $stmt = $pdo->prepare("SELECT * FROM base where base_id = :id");
  $stmt->execute(array(":id" => $_GET['base_id']));
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
 }
 else{
  $stmt = $pdo->prepare("SELECT * FROM visitor where visitor_id = :id");
  $stmt->execute(array(":id" => $_GET['visitor_id']));
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
 }
  echo json_encode($data);
}
    
?>

