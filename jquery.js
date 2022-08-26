$(document).ready(function(){
    fetch_users();
    function fetch_users(){
      data = "a";
      $.ajax({
        url:"fetch.php",
        method:"get",
        data:{data:data},
        dataType:"json",
        success:function(data){
          add='';
          for(var i=0; i < data.length; i++){  
              add+='<tr><td>'+data[i].name+'</td>';
              add+='<td>'+data[i].email+'</td>';
              add+='<td>'+data[i].password+'</td>';
              add+='<td><a href="#" id='+data[i].user_id+' class="edit" >Edit</a> /<a href="#" id='+data[i].user_id+' class="delete" >Delete</a> </td></tr>';
            }
          $("tbody").html(add);
        }
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
            console.log(data);
              if(data.error){
                  error_html = '<div class="alert alert-danger">'+data.error+'</div>';
                  $('#error').html(error_html);
                  $('#error').hide().slideDown().delay(5000).fadeOut(2000);
              }
              else{
                  $('#add_form')[0].reset();
                  $('#exampleModal').modal('hide');
                  success_html = '<div class="alert alert-success">'+data.success+'</div>';
                  fetch_users();
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
              fetch_users();
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
          $('#deleteModal').modal('hide');
          fetch_users();
          success_html = '<div class="alert alert-success">'+data+'</div>';
          $('#form_output').html(success_html);
          $('#form_output').hide().slideDown().delay(5000).fadeOut(2000);
        }
      })
    });
});
