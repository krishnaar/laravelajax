$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// get page data
function getPageData(){
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(date) {
       manageRow(data.data); 
    });
}

//add new table row

function manageRow(data){
    var rows = '';
    $.each( data, function(key, value) {
        rows = rows + '<tr>';
        rows = rows + '<td>'+value.title+'<td>';
        rows = rows + '<td>'+value.body+'<td>';
        rows = rows + '<td data-id=>"'+value.title+'">';
        rows = rows + '<button data-toggle="model" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button>';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
        

    })
}

// create
$(".crud-submit").click(function(e) {
    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var title = $("#create-item").find("input[name='title]").val();
    var body = $("#create-item").find("input[name='body]").val();
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: form_action,
        data:{title:title, body:body}
    }).done(function(data) {
        getPageData();
        $(".modal").modal('hide');
        toastr.success('Post Created Successfully', 'Success Alert', {timeOut:5000});
    });
});

//delete
$("body").on("click", "remove-item", function() {
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");
    $.ajax({
        dataType: 'json',
        type: 'delete',
        url: url + '/' + id,
    }).done(function(date) {
        c_obj.remove();
        toastr.success('Post Deleted Successfully', 'Success Alert', {timeOut:5000});
        getPageData();
    });
});

$("body").on("click", "remove-item", function() {
    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");
    $.ajax({
        dataType: 'json',
        type: 'delete',
        url: url + '/' + id,
    }).done(function(date) {
        c_obj.remove();
        toastr.success('Post Deleted Successfully', 'Success Alert', {timeOut:5000});
        getPageData();
    });
});