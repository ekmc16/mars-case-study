<?php
require_once "pdo.php";

$error='';
$success='';
if(isset($_POST)){
  if( isset($_POST['name']) && isset($_POST['email'])
     && isset($_POST['password']) && isset($_POST['user_id']) ) {

    // Data validation
    if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
        $error = 'Missing data';
    }

    else if ( strpos($_POST['email'],'@') === false ) {
        $error = 'Invalid E-mail Address';
    }
    else{
    $sql = "UPDATE users SET name = :name,
            email = :email, password = :password
            WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':user_id' => $_POST['user_id']));
    $success= 'Record updated';
    }
  }

// Guardian: Make sure that user_id is present
  if ( ! isset($_POST['user_id']) ) {
    $error = "Missing user_id";
  }

  $data = array(
  'error'     =>  $error,
  'success'   =>  $success
  );

echo json_encode($data);
}

?>