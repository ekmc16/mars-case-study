<?php
require_once "pdo.php";

if (isset($_GET)){
  $stmt = $pdo->query("SELECT * FROM base");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}
?>

