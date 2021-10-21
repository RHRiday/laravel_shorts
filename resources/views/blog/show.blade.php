@extends('apps.blog')

@section('content')
    @if (session()->has('success'))
        <div class="mb-2 alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @isset($user)
        <div class="my-2">
            <h1 class="text-center mb-1 bg-dark text-white py-2 rounded">{{ $user }}'s Blogs</h1>
            <hr>
        </div>
    @endisset
    <div class="container my-2">
        <h2 class="display-5 bg-info p-2 fw-bold ff-catamaran">
            <i class="fas fa-book-open"></i> {{ $blog->title }}
        </h2>
        <div class="my-1 p-1 d-flex justify-content-between">
            <p>
                Rifat
            </p>
            <button class="btn btn-sm btn-danger mx-1">Delete blog</button>
        </div>

        <div class="row">
            @foreach ($blog->contents as $content)
                <div class="col-12 my-2">
                    @switch($content->type)
                        @case('text')
                            <div class="bg-light p-2">
                                {!! $content->content !!}
                            </div>
                        @break
                        @case('image')
                            <img src="{{ $content->content }}" alt="Not a valid image" style="max-width: 100%">
                        @break
                        @case('code')
                            <div class="bg-dark text-warning p-2">
                                {{ $content->content }}
                            </div>
                        @break
                        @default

                    @endswitch
                </div>
            @endforeach
        </div>

        <div class="d-flex mt-5">
            <hr class="flex-grow-1">
            <div id="modals">
                <button class="btn btn-primary btn-add" type="button" data-bs-toggle="modal" data-bs-target="#contentModal">
                    <i class="fas fa-plus-circle text-light"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="contentModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="contentModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="contentModal">Choose the content</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-around flex-wrap mb-3">

                                <button class="btn btn-sm btn-primary mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#textInputModal"> <i class="fa fa-keyboard"></i> Text</button>
                                @include('apps.includes.add-content', ['type' => 'text'])

                                <button class="btn btn-sm btn-primary mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#imageInputModal"> <i class="fa fa-image"></i> Image</button>
                                @include('apps.includes.add-content', ['type' => 'image'])

                                <button class="btn btn-sm btn-primary mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target="#codeInputModal"> <i class="fa fa-code"></i> Code</button>
                                @include('apps.includes.add-content', ['type' => 'code'])

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="flex-grow-1">
        </div>
    </div>
@endsection
