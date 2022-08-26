<?php
require_once "pdo.php";

if (isset($_GET)){
  $stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}
    
?>

