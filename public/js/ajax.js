$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function addContent(type, id) {
    console.log(type);
    let content = $('#' + type + 'Content');
    $.ajax({
        type: "post",
        url: "/dokkoblog/" + id + "/update",
        data: {
            type: type,
            content: content.val()
        },
        success: function (response) {
            content.val('');
            $('trix-editor').html('');
            $('.btn-close').trigger('click');
            console.log(response);
        }
    });
}
