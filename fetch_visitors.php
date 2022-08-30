<?php
require_once "pdo.php";

if (isset($_GET)){
  $stmt = $pdo->query("SELECT visitor.visitor_id, CONCAT(visitor.first_name,' ',visitor.last_name) AS visitor, CONCAT(martian.first_name,' ',martian.last_name) AS host, base.base_name AS base FROM visitor LEFT JOIN martian ON visitor.host_id=martian.martian_id LEFT JOIN base ON martian.base_id=base.base_id");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}
?>

