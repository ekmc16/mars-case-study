<?php
require_once "pdo.php";

if (isset($_GET)){
  $stmt = $pdo->query("SELECT CONCAT(martian.first_name,' ',martian.last_name) AS name, base.base_name, CONCAT(second.first_name,' ',second.last_name) AS superior ,martian.martian_id FROM martian LEFT JOIN base ON martian.base_id = base.base_id LEFT JOIN martian as second ON martian.super_id = second.martian_id ORDER BY martian.martian_id");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}
?>

