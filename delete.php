<?php
require_once "pdo.php";


if(isset($_POST['user_id'])) {
    $sql = "DELETE FROM martian WHERE martian = :deleteID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':deleteID' => $_POST['martian_id']));
    $stats = 'Record deleted'; 
}

echo json_encode($stats);



?>
