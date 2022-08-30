<?php
require_once "pdo.php";

$error='';
$success='';

if(isset($_POST)){
  if( isset($_POST['first_name']) && isset($_POST['last_name'])
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
  elseif(isset($_POST['base_name']) && isset($_POST['date_founded'])){
    if ( strlen($_POST['base_name']) < 1){
      $error = 'Base name is required';
    }
    else{
      if($_POST['function'] == 'add'){
        if($_POST['date_founded'] ===''){
          $sql = "INSERT INTO base (base_name)
                  VALUES (:bname)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':bname' => $_POST['base_name']
          ));
        }
        else{
          $sql = "INSERT INTO base (base_name, founded)
                  VALUES (:bname, :founded)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':bname' => $_POST['base_name'],
              ':founded' => $_POST['date_founded']
          ));     
        }
        $success = 'Record Added';
      }
      else{
        if($_POST['date_founded'] ===''){
          $sql = "UPDATE base SET base_name = :bname,
                  founded = :founded
                  WHERE base_id = :bid";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':bname' => $_POST['base_name'],
              ':founded' => NULL,
              ':bid' => $_POST['base_id']
          ));
        }
        else{
          $sql = "UPDATE base SET base_name = :bname,
                  founded = :founded
                  WHERE base_id = :bid";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':bname' => $_POST['base_name'],
              ':founded' => $_POST['date_founded'],
              ':bid' => $_POST['base_id']
          ));
          
        }
        $success = 'Record Updated';
      }
    }
  }
  elseif(isset($_POST['v_fname']) && isset($_POST['v_lname']) && isset($_POST['host'])){
    if ( strlen($_POST['v_fname']) < 1 || strlen($_POST['v_lname']) < 1) {
      $error = 'Missing data';
    }
    else{
      if($_POST['function'] == 'add'){
        if($_POST['host'] === ''){
          $sql = "INSERT INTO visitor (first_name, last_name)
                  VALUES (:fname, :lname)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':fname' => $_POST['v_fname'],
              ':lname' => $_POST['v_lname'],
          ));
        }
        else{
          $sql = "INSERT INTO visitor (first_name, last_name, host_id)
                  VALUES (:fname, :lname, :hid)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':fname' => $_POST['v_fname'],
              ':lname' => $_POST['v_lname'],
              ':hid' => $_POST['host']
          ));
        }
        $success = 'Record Added';
      }
      else{
        if($_POST['host'] === ''){
          $sql = "UPDATE visitor SET first_name = :fname,
                  last_name = :lname, host_id = :hid
                  WHERE visitor_id = :vid";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':fname' => $_POST['v_fname'],
              ':lname' => $_POST['v_lname'],
              ':hid' => NULL,
              ':vid' => $_POST['visitor_id']
          ));
        }
        else{
          $sql = "UPDATE visitor SET first_name = :fname,
                  last_name = :lname, host_id = :hid
                  WHERE visitor_id = :vid";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ':fname' => $_POST['v_fname'],
              ':lname' => $_POST['v_lname'],
              ':hid' => $_POST['host'],
              ':vid' => $_POST['visitor_id']
          ));
        }
        $success = 'Record Updated';
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

