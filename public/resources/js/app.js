
$('.delete-list-btn').click(function(){
    $('#list-id').val($(this).data("id"));
    $('#delete-list-modal').modal("show");
});

$('#delete-list-form').submit(function(e){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: "/deletelist",
        data: $(this).serialize(),
        success:function(data){
            console.log(data);
            $('#delete-list-modal').modal("hide");
        },
        error(e){
            console.log(e);
        }
    });
});

$('.create-new-btn').click(function(){
    $('#new-list-modal').modal("show");
});

$('#new-list-form').submit(function(e){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: "/addlist",
        data: $(this).serialize(),
        success:function(data){
            console.log(data);
            $('#new-list-modal').modal("hide");
        },
        error(e){
            console.log(e);
        }
    });
});

$('.complete-btn').click(function(){
    console.log("click")
    var id = $(this).data('id');
    var completed = $(this).data('completed');

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        type:'POST',
        url: "/completeTask",
        data: {"id":id, "completed":completed},
        success:function(data){
            console.log(data);
            $('#new-list-modal').modal("hide");
        },
        error(e){
            console.log(e);
        }
    });
  
});


$('.add-task-btn').click(function(){
    $('#list-id').val($(this).data('id'));
    $('#edit-list-modal').modal("show");
});

$('#edit-list-form').submit(function(e){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: "/editlist",
        data: $(this).serialize(),
        success:function(data){
            console.log(data);
            $('#new-list-modal').modal("hide");
        },
        error(e){
            console.log(e);
        }
    });
});

$('.remove-task-btn').click(function(){
    var id = $(this).data('id');
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
        type:'POST',
        url: "/removeTask",
        data: {"id": id},
        success:function(data){
            console.log(data);
        },
        error(e){
            console.log(e);
        }
    });
   
});
