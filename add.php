<?php
require_once "pdo.php";

$error='';
$success='';

if(isset($_POST)){
  if( ($_POST['first_name']) && isset($_POST['last_name'])
      && isset($_POST['base_id']) && isset($_POST['superior_id'])) {
      // Data validation
      if ( strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1) {
          $error = 'Missing data';
      }
      else{$sql = "INSERT INTO users (first_name, last_name, base_id, super_id)
                VALUES (:fname, :lname, :baseid, :superid)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':fname' => $_POST['first_name'],
          ':lname' => $_POST['last_name'],
          ':baseid' => $_POST['base'],
          ':superid' => $_POST['superior']
        ));
      $success = 'Record Added';
      }
  }

  else{
    $error = 'No/Incomplete DATA';
  }

  $data = array(
    'error'     =>  $error,
    'success'   =>  $success
    );
  
  echo json_encode($data);
}

    
?>

