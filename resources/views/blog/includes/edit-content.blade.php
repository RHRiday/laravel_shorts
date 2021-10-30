<!-- Modal -->
<div class="modal fade" id="{{ $type . 'EditModal_' . $id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="{{ $type . 'EditModal_' . $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update the content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-around">
                <div class="mb-1 col-10">
                    @switch($type)
                        @case('header')
                            <input type="text" id="headerContent_{{ $id }}" class="form-control" name="content"
                                value="{{ $content }}" placeholder="Unique keyword that defines a section" required>
                        @break
                        @case('text')
                            <input id="textContent_{{ $id }}" type="hidden" name="content"
                                value="{{ $content }}" required />
                            <trix-editor input="textContent_{{ $id }}"
                                placeholder="Write your content here. You can also use this as an html codepen.">
                            </trix-editor>
                        @break
                        @case('image')
                            <input id="imageContent_{{ $id }}" class="form-control" name="content" type="text"
                                value="{{ $content }}" placeholder="Image url">
                            <p class="my-2 px-1"><strong>Tip:</strong>
                                Go to <a href="https://imgbb.com/" class="text-decoration-none"
                                    target="_blank">imgbb.com</a> and generate an image URL.
                            </p>
                        @break
                        @case('code')
                            <div class="form-floating">
                                <textarea class="form-control" name="content" placeholder="Paste your code here"
                                    id="codeContent_{{ $id }}" style="height: 100px"
                                    value="{{ $content }}">{{ $content }}</textarea>
                                <label for="codeContent_{{ $id }}">Paste your code here</label>
                            </div>
                        @break
                        @default

                    @endswitch
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button onclick="deleteContent({{ $id }},this)" class="btn btn-danger">Delete the
                    content</button>
                <button type="submit" onclick="updateContent({{ $id }},'{{ $type }}', this)"
                    class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
