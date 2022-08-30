<?php
require_once "pdo.php";


if(isset($_POST['martian_id'])) {
    $sql = "DELETE FROM martian WHERE martian_id = :deleteID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':deleteID' => $_POST['martian_id']));
    
}
elseif(isset($_POST['base_id'])) {
    $sql = "DELETE FROM base WHERE base_id = :deleteID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':deleteID' => $_POST['base_id']));
}
else{
    $sql = "DELETE FROM visitor WHERE visitor_id = :deleteID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':deleteID' => $_POST['visitor_id']));
}
$stats = 'Record deleted'; 
echo json_encode($stats);



?>
