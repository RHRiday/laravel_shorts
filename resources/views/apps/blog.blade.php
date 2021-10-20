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
                        <h4 class="fst-italic bg-light py-2 text-center rounded">Add a post</h4>
                        <form action="{{ route('blog.create') }}" method="POST">
                            @csrf
                            <div class="mb-2 row">
                                <label for="title" class="col-auto col-form-label">Title :</label>
                                <div class="col-auto">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Ex: How to dance">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="blog_tags" class="col-auto col-form-label">Tag(s) :</label>
                                <div class="col-auto">
                                    <select class="blog_tags form-control" name="tags[]" multiple="multiple">
                                        @forelse ($tags as $tag)
                                            <option value="{{ $tag }}">{{ $tag }}</option>
                                        @empty
                                            {{ __('nothing') }}
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="border-top d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-sm btn-primary mb-3">Create post</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="order-1 order-lg-2">
                    <div class="p-2">
                        <h4 class="fst-italic bg-dark py-2 text-white text-center rounded">Tags</h4>
                        <ol class="list-unstyled mb-0">
                            @forelse ($tags as $tag)
                                <li><a href="#">{{ $tag }}</a></li>
                            @empty
                                <li class="fst-italic small">No tags available</li>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
