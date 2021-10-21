<!-- Modal -->
<div class="modal fade" id="{{ $type . 'InputModal' }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="{{ $type . 'InputModal' }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $type . 'InputModal' }}">Input the content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('blog.addContent', $blog->id) }}" method="post">
                @csrf
                <div class="modal-body d-flex justify-content-around">
                    <div class="mb-1">
                        @switch($type)
                            @case('text')
                                <p class="w-100">
                                    <input id="textContent" type="hidden" name="textContent" value="{{ old('textContent') }}"
                                        required />
                                    <trix-editor input="textContent"
                                        placeholder="Write your content here. You can also use this as an html codepen.">
                                    </trix-editor>
                                </p>
                            @break
                            @case('image')
                                <input class="form-control" name="imageContent" type="text" placeholder="Import image address">
                            @break
                            @case('code')
                                <p class="w-100">
                                    <input id="codeContent" type="hidden" name="codeContent" value="{{ old('codeContent') }}"
                                        required />
                                    <trix-editor input="codeContent"
                                        placeholder="Write your content here. You can also use this as an html codepen.">
                                    </trix-editor>
                                </p>
                            @break
                            @default

                        @endswitch
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
