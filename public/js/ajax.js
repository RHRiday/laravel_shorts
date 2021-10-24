$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function addContent(type) {
    switch (type) {
        case 'text':
            let content = $('#textContent').val();
            $.ajax({
                type: "post",
                url: "url",
                data: "data",
                dataType: "dataType",
                success: function (response) {
                    
                }
            });
            break;
    
        default:
            break;
    }
}