<?php
require_once "pdo.php";

$error='';
$success='';

if(isset($_POST)){
  if( ($_POST['name']) && isset($_POST['email'])
      && isset($_POST['password'])) {
      // Data validation
      if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
          $error = 'Missing data';
      }

      else if ( strpos($_POST['email'],'@') === false ) {
          $error = 'Invalid E-mail Address';
      }

      else{$sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':name' => $_POST['name'],
          ':email' => $_POST['email'],
          ':password' => $_POST['password']));
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

