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
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <h1 class="display-4 fst-italic ff-playfair">Title of a longer featured blog post</h1>
            <div class="col-md-6 px-0">
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                    efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
            </div>
        </div>
        <div class="row mb-2">
            @forelse ($posts as $post)
                <div class="col-md-6">
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">{{ $post->tag }}</strong>
                            <h3 class="mb-0">{{ $post->title }}</h3>
                            <div class="mb-1 text-muted">{{ date('F j', strtotime($post->created_at)) }}</div>
                            <p class="card-text mb-auto">{{ substr($post->description, 0, 190) }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-auto d-none d-lg-block overflow-hidden" style="width: 200px; height:300px;">
                            <img class="bd-placeholder-img" src="{{ asset('images/post/' . $post->img_path) }}">
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-6">
                    No posts found
                </div>
            @endforelse
        </div>
    </div>
@endsection
