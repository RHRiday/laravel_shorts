$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function addContent(type, id, button) {
    $(button).prop('disabled', true);
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
            $('trix-editor[input=' + type + 'Content]').html('');
            appendContent(response.type, response.content);
            $('.btn-close').trigger('click');
            $(button).prop('disabled', false);
        }
    });
}

function appendContent(type, content) {
    switch (type) {
        case 'text':
            toAppend = `<div class="bg-light p-2 fs-5 overflow-auto mt-3 rounded ff-merriweather">` + content + `</div>`;
            break;

        case 'header':
            toAppend = `<div class="bg-light p-2 fs-5 overflow-auto mt-3 rounded ff-catamaran"><h3>` + content + `<h3></div>`;
            break;

        case 'image':
            toAppend = `<img src="` + content + `" alt="Not a valid image" class="mt-3 w-100">`;
            break;

        case 'code':
            toAppend = `<div class="p-2 mt-3 ff-source-code"><pre class="code">` + content + `</pre></div>`;
            break;

        default:
            break;
    }

    appendFinal =
        `<div class="col-12 my-2 position-relative">
            <div class="position-absolute top-0 end-0">
                <button onclick="window.location.reload()" class="btn btn-sm btn-link badge bg-info reload-btn" type="button">
                    Refresh to edit
                </button>
            </div>` + toAppend +
        `</div>`;

    $('#contents').append(appendFinal);
}

function updateContent(id, type, button) {
    $(button).prop('disabled', true);
    let content = $('#' + type + 'Content_' + id);
    $.ajax({
        type: "put",
        url: "/dokkoblog/content/" + id + "/edit",
        data: {
            content: content.val()
        },
        success: function (response) {
            container = $('#content_' + id);
            changeContent(container, response);
            $('.btn-close').trigger('click');
            $(button).prop('disabled', false);
        }
    });
}

function changeContent(container, response) {
    if (response.type == 'header' || response.type == 'code') {
        container.text(response.content);
    } else if (response.type == 'text') {
        // this is a text
        container.html(response.content);
    } else {
        // this is an image
        container.attr('src', response.content);
    }
}

function deleteContent(id, button) {
    $(button).prop('disabled', true);
    $.ajax({
        type: "delete",
        url: "/dokkoblog/content/" + id + "/delete",
        success: function (response) {
            $('.btn-close').trigger('click');
            $('#content_' + id).parent().remove();
        }
    });
}

function addFfq(button) {
    $(button).prop('disabled', true);
    $.ajax({
        type: "post",
        url: "/dokkofaq/create",
        data: {
            question: $('#question').val(),
            answer: $('#answer').val(),
            tag: $('#tag').val()
        },
        success: function (response) {
            let accordion = `
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button ff-merriweather" type="button" data-bs-toggle="collapse"
                                data-bs-target="#new_` + response.id + `" aria-expanded="true"
                                aria-controls="new_` + response.id + `">
                                <strong>New: </strong>` + response.question + `
                            </button>
                        </h2>
                        <div id="new_` + response.id + `" class="accordion-collapse collapse show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <pre class="ff-source-code">` + response.answer + `</pre>
                            </div>
                        </div>
                    </div>
                `;
            $('.btn-close').trigger('click');
            $('#question').val('');
            $('#answer').val('');
            $('#tag').val('');
            $('#accordionPanelsStayOpen').prepend(accordion);
            $(button).prop('disabled', false);
        }
    });
}
