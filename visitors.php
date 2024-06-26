<?php
require_once "pdo.php";
session_start();

$stmt = $pdo->query("SELECT martian_id,CONCAT(first_name,' ',last_name) AS martian FROM martian");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DICTMARS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
  <body class="d-flex flex-column">
    <?php
        require_once("nav.php")
    ?>
  <main class="flex-shrink-0 mb-5">
    <div class="container mb-5">
        <div class="row">
            <p class="text-center h2">DICTMARS</p>
            <div class="text-start pt-5 mb-3"><a href="#" id="openadd"type="button" class="btn btn-primary">Add New</a></div>
            <span id="form_output"></span>
        </div>
        <table id="visitorsTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Visitor</th>
                <th>Host</th>
                <th>Base</th>
                <th></th>
            </tr>
        </tfoot>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
                <th>Alien</th>
                <th>Superior</th>
                <th>Base</th>
            </tr>
        </tfoot>
        </table>
      </div>
   


<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add A New Visitor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addvisitor_form" method="post" class="form-control" autocomplete="off">
          <span id="error"></span>
        <div class="modal-body">
          <p>First Name:
          <input class="form-control" type="text" name="v_fname"></p>
          <p>LastName:
          <input class="form-control" type="text" name="v_lname"></p>
          <p>Host:
            <select name="host" class="form-select">
              <option value="">N/A</option>
            <?php
              if(!empty($result)) { 
                foreach($result as $row) {
                ?>
                  <option value="<?php echo $row["martian_id"]; ?>"><?php echo $row["martian"]; ?></option>
                <?php
                }
              }
            ?>
            </select>
          </p>
          <input class="form-control" type="text" name="function" value="add" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary" />
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editvisitor_form" method="post" class="form-control" autocomplete="off">
          <span id="error1"></span>
        <div class="modal-body">
        <p>First Name:
          <input class="form-control" type="text" name="v_fname" id="new_firstname"></p>
          <p>Last Name:
          <input class="form-control" type="text" name="v_lname" id="new_lastname"></p>
          <p>Host:
            <select class="form-select" name="host" id="new_host">
              <option value>N/A</option>
              <?php
              if(!empty($result)) { 
                foreach($result as $row) {
                ?>
                  <option value="<?php echo $row["martian_id"]; ?>"><?php echo $row["martian"]; ?></option>
                <?php
                }
              }
            ?>
            </select>
          </p>
          <input class="form-control" type="text" name="function" value="update" hidden>
          <input class="form-control" type="text" name="visitor_id" id="updateID" value="" hidden>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" name="submit" class="btn btn-primary" />
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="deletevisitor_form" method="post" class="form-control">
        <div class="modal-body">
              <h1> Are you sure you want to delete this record?
              <input class="form-control" type="text" name="visitor_id" id="deleteID" value="" hidden></p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" name="delete" class="btn btn-primary" value="Delete"/>
        </div>
        </form>
      </div>
    </div>
  </div>
</main>
<?php
    require_once("footer.php")
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="jquery.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
  fetch_visitors()
  $("#visitors").addClass('active');
  $("#visitors").attr('aria-current','page');
});
</script>
</body>
</html>

