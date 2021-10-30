@extends('apps.blog')

@section('content')
    <div class="section my-5">
        <h2 class="display-3 bg-tint py-1 fw-bold text-center ff-catamaran">
            <i class="fab fa-pied-piper-square"></i> Drafts of Dokko
        </h2>
        <h6 class="text-center ff-catamaran py-1">Learn new things daily</h6>
        <div class="row g-5">
            @forelse ($blogs as $blog)
                <div class="col-lg-6">
                    <div class="border bg-tint-light shadow-sm">
                        <div class="thumbnail">
                            @if ($blog->contents->where('type', 'image')->isEmpty())
                            @else
                                <img src="{{ $blog->contents->where('type', 'image')->first()->content }}"
                                    alt="No image found" class="img-fluid">
                            @endif
                        </div>
                        <div class="p-3">
                            <div class="mb-2">
                                @foreach ($blog->tags as $tag)
                                    <a href="{{ route('blog', ['tag', $tag->tag]) }}" class="small me-2">
                                        <i class="fas fa-tag align-middle"></i>{{ $tag->tag }}</a>
                                @endforeach
                            </div>
                            <h5 class="ff-poppins mb-3">
                                {{ $blog->title }}
                            </h5>
                            <p>
                                @if ($blog->contents->where('type', 'text')->isEmpty())
                                    <span class='text-danger'>Content not found!!</span>
                                @else
                                    {{ mb_substr(strip_tags($blog->contents->where('type', 'text')->first()->content), 0, 250) }}
                                @endif
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="col-auto float-end border-info btn btn-sm btn-info">Read draft
                                </a>
                            </p>
                            <div class="my-2">
                                <a href="{{ route('blog', ['user', $blog->user_id]) }}" class="text-decoration-none"><i
                                        class="far fa-user-circle align-middle"></i>
                                    {{ $blog->user->name }}
                                </a>
                                <span class="col-4 mt-1 text-muted small float-end text-end"> —
                                    {{ date('M d, Y', strtotime($blog->created_at)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger my-2">
                    No blogs found !!
                </div>
            @endforelse
        </div>
    </div>
@endsection
