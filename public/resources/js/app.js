
$('.delete-list-btn').click(function(){
    $('#delete-list-id').val($(this).data("id"));
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
            location.reload();
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
            location.reload();
            $('#new-list-modal').modal("hide");
        },
        error(e){
            console.log(e);
        }
    });
});

$('.complete-btn').click(function(){
    var btn = $(this);
    var spanText = $('.task-'+$(this).data('id'));
    var id = $(this).data('id');
    var completed = $(this).data('completed');
    console.log(spanText);
    
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
            console.log($(this));
            if(btn.hasClass('btn-success')){
                console.log("fklösd")
                btn.removeClass('btn-success');
                spanText.css("text-decoration", "none")
            }else{
                console.log("else")
                btn.addClass('btn-success');
                spanText.css("text-decoration", "line-through")
            }
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
            location.reload();
            $('#new-list-modal').modal("hide");
        },
        error(e){
            console.log(e);
        }
    });
});

$('.remove-task-btn').click(function(){
    var id = $(this).data('id');
    var li = $('.li-task-'+$(this).data('id')); 
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
            li.remove();
            console.log(data);
        },
        error(e){
            console.log(e);
        }
    });
   
});
