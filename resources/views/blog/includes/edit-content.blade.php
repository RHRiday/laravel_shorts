<!-- Modal -->
<div class="modal fade" id="{{ $type . 'EditModal_' . $id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="{{ $type . 'EditModal_' . $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update the content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('blog.editContent', $id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body d-flex justify-content-around">
                    <div class="mb-1">
                        @switch($type)
                            @case('text')
                                <p class="w-100">
                                    <input id="textContent{{ '_' . $id }}" type="hidden" name="content"
                                        value="{{ $content }}" required />
                                    <trix-editor input="textContent{{ '_' . $id }}"
                                        placeholder="Write your content here. You can also use this as an html codepen.">
                                    </trix-editor>
                                </p>
                            @break
                            @case('image')
                                <input class="form-control" name="content" type="text" value="{{ $content }}"
                                    placeholder="Import image address">
                            @break
                            @case('code')
                                <p class="w-100">
                                    <input type="hidden" name="type" value="code">
                                    <input id="codeContent{{ '_' . $id }}" type="hidden" name="content"
                                        value="{{ $content }}" required />
                                    <trix-editor input="codeContent{{ '_' . $id }}"
                                        placeholder="Write your content here. You can also use this as an html codepen.">
                                    </trix-editor>
                                </p>
                            @break
                            @default

                        @endswitch
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <a href="{{ route('blog.deleteContent', $id) }}"
                        onclick="event.preventDefault(); document.getElementById('deleteContentForm').submit();"
                        class="btn btn-danger">Delete the content</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <form id="deleteContentForm" action="{{ route('blog.deleteContent', $id) }}" method="POST"
            class="d-none">
            @csrf
            @method('delete')
        </form>
    </div>
</div>
