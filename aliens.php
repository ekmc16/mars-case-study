<?php
require_once "pdo.php";
session_start();

$stmt = $pdo->query("SELECT base_id,base_name FROM base");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt1 = $pdo->query("SELECT CONCAT(first_name,' ',last_name) AS name,martian_id FROM martian");
$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      main > .container {
        padding: 60px 15px 0;
        }
    </style>

</head>
  <body class="d-flex flex-column">
    <?php
        require_once("nav.php")
    ?>
  <main class="flex-shrink-0 mb-5">
    <div class="container mb-5">
        <div class="row">
            <p class="text-center h2">DICTMARS</p>
            <a href="#" id="openadd"type="button" class="btn btn-primary">Add New</a>
            <span id="form_output"></span>
        </div>
        <table id="testing123" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Alien name</th>
                <th>Superior name</th>
                <th>Base</th>
                <th></th>
            </tr>
        </tfoot>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
                <th>Alien name</th>
                <th>Superior name</th>
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
          <h5 class="modal-title" id="exampleModalLabel">Add A New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="add_form" method="post" class="form-control">
          <span id="error"></span>
        <div class="modal-body">
          <p>First Name:
          <input class="form-control" type="text" name="first_name"></p>
          <p>LastName:
          <input class="form-control" type="text" name="last_name"></p>
          <p>Base:
          <select id="base" name="base" class="form-select">
            <?php
              if(!empty($result)) { 
                foreach($result as $row) {
              ?>
                  <option value="<?php echo $row["base_id"]; ?>"><?php echo $row["base_name"]; ?></option>
            <?php
                }
              }
            ?>
            </select>
          </p>
          <p>Base:
            <select id="superior" name="superior" class="form-select">
            <?php
              if(!empty($result1)) { 
                foreach($result1 as $row) {
                ?>
                  <option value="<?php echo $row["martian_id"]; ?>"><?php echo $row["name"]; ?></option>
                <?php
                }
              }
            ?>
            </select>
          </p>
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
        <form id="edit_form" method="post" class="form-control">
          <span id="error1"></span>
        <div class="modal-body">
              <p>Name:
              <input class="form-control" type="text" name="name" id="new_name"></p>
              <p>Email:
              <input class="form-control" type="text" name="email" id="new_email"></p>
              <p>Password:
              <input class="form-control" type="text" name="password" id="new_password"></p>
              <input class="form-control" type="text" name="user_id" id="updateID" hidden></p>
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
        <form id="delete_form" method="post" class="form-control">
        <div class="modal-body">
              <h1> Are you sure you want to delete this record?
              <input class="form-control" type="text" name="user_id" id="deleteID" value="" hidden></p>
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
<script type="text/javascript">
$(document).ready(function(){
  $("#aliens").addClass('active');
  $("#aliens").attr('aria-current','page');
  console.log($("#aliens").attr('aria-current'));
});
</script>
<script type="text/javascript" src="jquery.js"></script> 
</body>
</html>

