@extends('apps.app', [
'title' => 'DokkoBlog',
'headerRoute' => 'blog'
])

@section('app')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-2 order-lg-1">

                @yield('content')

            </div>
            <div class="col-lg-3 order-1 order-lg-2">
                <div class="order-2 order-lg-1">
                    <div class="p-2">
                        @auth
                            <h4 class="fst-italic bg-tint py-2 text-center rounded">Add draft</h4>
                            <form action="{{ route('blog.create') }}" method="POST">
                                @csrf
                                <div class="mb-2 row">
                                    <label for="title" class="col-auto col-form-label">Title :</label>
                                    <div class="col-auto">
                                        <input type="text" name="title" class="form-control" id="title"
                                            placeholder="Ex: Creating an object in JavaScript" required
                                            value="{{ old('title') }}">
                                    </div>
                                    <div class="col-12">
                                        @if ($errors->has('title'))
                                            @foreach ($errors->get('title') as $message)
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @endforeach
                                        @endif
                                        @if ($errors->has('slug'))
                                            @foreach ($errors->get('slug') as $message)
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="blog_tags" class="col-auto col-form-label">Tag(s) :</label>
                                    <div class="col-auto">
                                        <select class="blog_tags form-control" name="tags[]" multiple="multiple" required>
                                            @forelse ($tags as $tag)
                                                <option value="{{ $tag }}">{{ $tag }}</option>
                                            @empty
                                                {{ __('nothing') }}
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        @if ($errors->has('tags'))
                                            @foreach ($errors->get('tags') as $message)
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="border-top d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-sm btn-primary mb-3">Publish</button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-danger text-center">
                                Login to publish blogs
                            </div>
                        @endauth
                    </div>
                </div>
                <div class="order-1 order-lg-2">
                    <div class="p-2">
                        <h4 class="fst-italic bg-tint py-2 text-center rounded">Tags</h4>
                        <ol class="list-unstyled mb-0">
                            @forelse ($tags as $tag)
                                <li><a href="{{ route('blog', ['tag', $tag]) }}">{{ $tag }}</a></li>
                            @empty
                                <li class="fst-italic small">No tags available</li>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/trix.js') }}"></script>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // $('button[type=submit]').notify('Done', {
            //     autoHideDelay: 3000,
            //     className: 'success',
            //     position: 'bottom center'
            // });
            $("#search").on("keyup", function() {
                $('.accordion-collapse').removeClass('show');
                var value = $(this).val().toLowerCase();
                $("button.accordion-button").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $('.blog_tags').select2({
                tags: true,
                placeholder: "Ex: ReactJs",
                maximumSelectionLength: -1,
                width: '100%'
            });

            new Typed('.typed', {
                strings: ['Frequently asked dokko'],
                typeSpeed: 100,
                loop: true,
                cursorChar: '',
            });

            document.addEventListener("trix-file-accept", event => {
                event.preventDefault()
            });
            hljs.highlightAll();
        });
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.code').forEach((block) => {
                hljs.highlightBlock(block);
            });
        });
    </script>
@endsection