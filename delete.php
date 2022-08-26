<?php
require_once "pdo.php";


if(isset($_POST['user_id'])) {
    $sql = "DELETE FROM users WHERE user_id = :deleteID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':deleteID' => $_POST['user_id']));
    $stats = 'Record deleted'; 
}

echo json_encode($stats);



?>
