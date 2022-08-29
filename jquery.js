function fetch_martians(){
  $("#testing123").DataTable({
    destroy: true,
    ajax: {
      url: 'fetch.php',
      dataSrc: '',
  },
    columns: [
      { data: "name" },
      { data: "superior" },
      { data: "base_name" },
      {
        sortable: false,
        "render": function ( data, type, full, meta ) {
            var buttonID = full.martian_id;
            return '<a href="#" id='+buttonID+' class="editmartian btn btn-xs btn-secondary">Edit</a><a href="#" id='+buttonID+' class="deletemartian btn btn-xs btn-danger">Delete</a>';
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
      url:"save.php",
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
              fetch_martians();
              $('#form_output').html(success_html);
              $('#form_output').hide().slideDown().delay(5000).fadeOut(2000);
          }

      }
  })
});
$(document).on('click','.editmartian',function(){
  $("#editModal").modal("show");
  // $('#new_superior option:first').prop('selected',true);
  // $('#new_base option:first').prop('selected',true);
  martian_id = $(this).attr('id');
  $.ajax({
    url:"fetchinfo.php",
    method:"get",
    data:{martian_id:martian_id},
    dataType:"json",
    success:function(data){
      console.log(data.super_id);
      console.log(data.base_id);
      $("#new_firstname").val(data.first_name);
      $("#new_lastname").val(data.last_name);
      $("#new_superior option[value="+ data.super_id +"]").prop("selected", true);
      $("#new_base option[value="+ data.base_id +"]").prop("selected", true);
      $("#updateID").val(data.martian_id);
    }
  })
});
$(document).on('click','.deletemartian',function(){
  $("#deleteModal").modal("show");
  id = $(this).attr('id');
  $("#deleteID").val(id);
});
$("#editmartian_form").submit(function(e){
  e.preventDefault();
  var form_data = $(this).serialize();
  console.log(form_data);
  $.ajax({
    url:"save.php",
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
          $('#editmartian_form')[0].reset();
          $('#editModal').modal('hide');
          fetch_martians();
          success_html = '<div class="alert alert-success">'+data.success+'</div>';
          $('#form_output').html(success_html);
          $('#form_output').hide().slideDown().delay(5000).fadeOut(2000);
      }
    }
  })
});
$("#deletemartian_form").submit(function(e){
  e.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
    url:"delete.php",
    method:"POST",
    data:form_data,
    dataType:"json",
    success:function(data){

      fetch_martians();
      $('#deleteModal').modal('hide');
      success_html = '<div class="alert alert-success">'+data+'</div>';
      $('#form_output').html(success_html);
      $('#form_output').hide().slideDown().delay(5000).fadeOut(2000);
    }
  })
});
