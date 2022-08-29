<?php
require_once "pdo.php";

$error='';
$success='';

if(isset($_POST)){
  if( ($_POST['first_name']) && isset($_POST['last_name'])
      && isset($_POST['base']) && isset($_POST['superior'])) {
      // Data validation
      if ( strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1) {
          $error = 'Missing data';
      }
      else{
        if($_POST['base'] === '' && $_POST['superior'] ===''){
          if($_POST['function'] == 'add'){
            $sql = "INSERT INTO martian (first_name, last_name)
                  VALUES (:fname, :lname)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fname' => $_POST['first_name'],
                ':lname' => $_POST['last_name']
            ));
            $success = 'Record Added';
          }
          elseif($_POST['function'] == 'update'){
            $sql = "UPDATE martian SET first_name = :fname,
                    last_name = :lname, super_id = :sid,
                    base_id = :bid
                    WHERE martian_id = :mid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fname' => $_POST['first_name'],
                ':lname' => $_POST['last_name'],
                ':sid' => NULL,
                ':bid' => NULL,
                ':mid' => $_POST['martian_id']));
            $success= 'Record updated';
          }
        }
        elseif($_POST['base'] === ''){
          if($_POST['function'] == 'add'){
            $sql = "INSERT INTO martian (first_name, last_name, super_id)
                    VALUES (:fname, :lname, :superid)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fname' => $_POST['first_name'],
                ':lname' => $_POST['last_name'],
                ':superid' => $_POST['superior']
            ));
            $success = 'Record Added';
          }
          elseif($_POST['function'] == 'update'){
            $sql = "UPDATE martian SET first_name = :fname,
                    last_name = :lname, super_id = :sid,
                    base_id = :bid
                    WHERE martian_id = :mid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fname' => $_POST['first_name'],
                ':lname' => $_POST['last_name'],
                ':sid' => $_POST['superior'],
                ':bid' => NULL,
                ':mid' => $_POST['martian_id']));
            $success= 'Record updated';
          }
        }
        elseif(($_POST['superior']) === ''){
          if($_POST['function'] == 'add'){
            $sql = "INSERT INTO martian (first_name, last_name, base_id)
                    VALUES (:fname, :lname, :baseid)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fname' => $_POST['first_name'],
                ':lname' => $_POST['last_name'],
                ':baseid' => $_POST['base']
            ));
            $success = 'Record Added';
          }
          elseif($_POST['function'] == 'update'){
            $sql = "UPDATE martian SET first_name = :fname,
                    last_name = :lname, super_id = :sid,
                    base_id = :bid
                    WHERE martian_id = :mid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fname' => $_POST['first_name'],
                ':lname' => $_POST['last_name'],
                ':sid' => NULL,
                ':bid' => $_POST['base'],
                ':mid' => $_POST['martian_id']));
            $success= 'Record updated';
          }
        }
        else{
          if($_POST['function'] == 'add'){
          $sql = "INSERT INTO martian (first_name, last_name, base_id, super_id)
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
          elseif($_POST['function'] == 'update'){
            $sql = "UPDATE martian SET first_name = :fname,
                    last_name = :lname, super_id = :sid,
                    base_id = :bid
                    WHERE martian_id = :mid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':fname' => $_POST['first_name'],
                ':lname' => $_POST['last_name'],
                ':sid' => $_POST['superior'],
                ':bid' => $_POST['base'],
                ':mid' => $_POST['martian_id']));
            $success= 'Record updated';
          }
        }
      }
  }

  else{
    $error = 'ERROR';
  }

  $data = array(
    'error'     =>  $error,
    'success'   =>  $success
    );
  
  echo json_encode($data);
}

    
?>

