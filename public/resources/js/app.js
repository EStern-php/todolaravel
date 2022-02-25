

$('.create-new-btn').click(function(){
    $('#new-list-modal').modal("show");
});

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