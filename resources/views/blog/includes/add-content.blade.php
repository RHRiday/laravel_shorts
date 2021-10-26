<!-- Modal -->
<div class="modal fade" id="{{ $type . 'InputModal' }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="{{ $type . 'InputModal' }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input the content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-around">
                <div class="col-10 mb-1">
                    @switch($type)
                        @case('header')
                            <input type="hidden" name="type" value="header">
                            <input class="form-control" type="text" name="content" value="{{ old('headerContent') }}"
                                placeholder="Unique keyword that defines a section" id="headerContent" required>
                        @break
                        @case('text')
                            <input type="hidden" name="type" value="text">
                            <input id="textContent" type="hidden" name="content" value="{{ old('textContent') }}"
                                required />
                            <trix-editor input="textContent"
                                placeholder="Write your content here. You can also use this as an html codepen.">
                            </trix-editor>
                        @break
                        @case('image')
                            <input type="hidden" name="type" value="image">
                            <input class="form-control" name="content" type="text" value="{{ old('iamgeContent') }}"
                                placeholder="Import image address" id="imageContent">
                        @break
                        @case('code')
                            <input type="hidden" name="type" value="code">
                            <input id="codeContent" type="hidden" name="content" value="{{ old('codeContent') }}"
                                required />
                            <trix-editor input="codeContent"
                                placeholder="Write your content here. You can also use this as an html codepen.">
                            </trix-editor>
                        @break
                        @default

                    @endswitch
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="addContent('{{ $type }}' , {{ $blog->id }}, this)"
                    class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
