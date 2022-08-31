<?php
require_once "pdo.php";

if (isset($_GET)){
  $stmt = $pdo->query("SELECT b.base_name, CONCAT(m.first_name,' ',m.last_name) AS name, COUNT(m2.martian_id) AS members FROM base AS b LEFT JOIN martian AS m ON b.base_id=m.base_id LEFT JOIN martian AS m2 ON m.base_id=m2.base_id WHERE m.super_id IS NULL GROUP BY m2.base_id ORDER BY b.base_id");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}
?>

