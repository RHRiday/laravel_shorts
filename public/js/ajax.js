$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function addContent(type, id) {
    console.log(type);
    let content = $('#' + type + 'Content').val();
    $.ajax({
        type: "post",
        url: "/dokkoblog/" + id + "/update",
        data: {
            type: type,
            content: content
        },
        success: function (response) {
            console.log(response);
        }
    });
}
