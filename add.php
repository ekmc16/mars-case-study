<?php
require_once "pdo.php";

// $error='';
// $success='';

// if(isset($_POST)){
//   if( ($_POST['first_name']) && isset($_POST['last_name'])
//       && isset($_POST['base']) && isset($_POST['superior'])) {
//       // Data validation
//       if ( strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1) {
//           $error = 'Missing data';
//       }
//       else{
        $sql = "INSERT INTO martian (first_name, last_name, base_id, super_id)
                VALUES (:fname, :lname, :baseid, :superid)";
        $stmt = $pdo->prepare($sql);
        $a=$stmt->execute(array(
            ':fname' => 'test',
            ':lname' => 'test',
            ':baseid' => '',
            ':superid' => ''
          ));
        echo $a;
        // $success = 'Record Added';
//       }
//   }

//   else{
//     $error = 'ERROR';
//   }

//   $data = array(
//     'error'     =>  $error,
//     'success'   =>  $success
//     );
  
//   echo json_encode($data);
// }

    
?>

