$(document).ready(function(){
  fetch_aliens();
  function fetch_aliens(){
    $("#testing123").DataTable({
      destroy: true,
      ajax: {
        url: 'fetch.php',
        dataSrc: '',
    },
      columns: [
        { data: "email" },
        { data: "email" },
        { data: "password" },
        {
          sortable: false,
          "render": function ( data, type, full, meta ) {
              var buttonID = full.user_id;
              return '<a href="#" id='+buttonID+' class="edit btn btn-xs btn-secondary">Edit</a><a href="#" id='+buttonID+' class="delete btn btn-xs btn-danger">Delete</a>';
          }
        }
      ],
    });
  }
$("#openadd").click(function(e){
  e.preventDefault();
  $("#exampleModal").modal("show");
});
$("#add_form").submit(function(e){
  e.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
      url:"add.php",
      method:"POST",
      data:form_data,
      dataType:"json",
      success:function(data){
          if(data.error){
              error_html = '<div class="alert alert-danger">'+data.error+'</div>';
              $('#error').html(error_html);
              $('#error').hide().slideDown().delay(5000).fadeOut(2000);
          }
          else{
              $('#add_form')[0].reset();
              $('#exampleModal').modal('hide');
              success_html = '<div class="alert alert-success">'+data.success+'</div>';
              fetch_aliens();
              $('#form_output').html(success_html);
              $('#form_output').hide().slideDown().delay(5000).fadeOut(2000);
          }

      }
  })
});
$(document).on('click','.edit',function(){
  $("#editModal").modal("show");
  id = $(this).attr('id');
  $.ajax({
    url:"fetchinfo.php",
    method:"get",
    data:{id:id},
    dataType:"json",
    success:function(data){
      $("#new_name").val(data.name);
      $("#new_email").val(data.email);
      $("#new_password").val(data.password);
      $("#updateID").val(data.user_id);
    }
  })
});
$(document).on('click','.delete',function(){
  $("#deleteModal").modal("show");
  id = $(this).attr('id');
  $("#deleteID").val(id);
});
$("#edit_form").submit(function(e){
  e.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
    url:"edit.php",
    method:"POST",
    data:form_data,
    dataType:"json",
    success:function(data){
      if(data.error){
          error_html = '<div class="alert alert-danger">'+data.error+'</div>';
          $('#error1').html(error_html);
          $('#error1').hide().slideDown().delay(5000).fadeOut(2000);
      }
      else{
          $('#edit_form')[0].reset();
          $('#editModal').modal('hide');
          fetch_aliens();
          success_html = '<div class="alert alert-success">'+data.success+'</div>';
          $('#form_output').html(success_html);
          $('#form_output').hide().slideDown().delay(5000).fadeOut(2000);
      }
    }
  })
});
$("#delete_form").submit(function(e){
  e.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
    url:"delete.php",
    method:"POST",
    data:form_data,
    dataType:"json",
    success:function(data){

      fetch_aliens();
      $('#deleteModal').modal('hide');
      success_html = '<div class="alert alert-success">'+data+'</div>';
      $('#form_output').html(success_html);
      $('#form_output').hide().slideDown().delay(5000).fadeOut(2000);
    }
  })
});
});
