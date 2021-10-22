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
        <h2 class="display-3 bg-info py-1 fw-bold text-center ff-catamaran">
            <i class="fab fa-pied-piper-square"></i> Drafts of Dokko
        </h2>
        <h6 class="text-center ff-catamaran py-1">Learn new things daily</h6>
        @forelse ($blogs as $blog)
            <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('blog', ['user', $blog->user_id]) }}"
                            class="btn btn-link text-info text-decoration-none"><i
                                class="far fa-user-circle align-middle"></i>
                            {{ $blog->user->name }}
                        </a>
                    </div>
                    <div class="col-6 d-flex flex-row-reverse">
                        @foreach ($blog->tags as $tag)
                            <a href="{{ route('blog', ['tag', $tag->tag]) }}" class="btn btn-link text-info">#{{ $tag->tag }}</a>
                        @endforeach
                    </div>
                </div>
                <h1 class="display-5 fst-italic ff-playfair">{{ $blog->title }}</h1>
                <div class="col-md-6 px-0">
                    <p class="lead my-3">
                        @php
                            $object = $blog->contents->where('type', 'text');
                            
                            if ($object->isEmpty()) {
                                echo "<span class='text-danger'>Content not found!!";
                            } else {
                                echo mb_substr(strip_tags($object->first()->content), 0, 250);
                            }
                        @endphp
                    </p>
                    <p class="lead mb-0">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="text-info">View...</a>
                    </p>
                </div>
            </div>
        @empty
            <div class="alert alert-danger my-2">
                No blogs found !!
            </div>
        @endforelse
    </div>
@endsection
