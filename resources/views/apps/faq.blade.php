@extends('apps.app', [
'title' => 'DokkoFAQ',
'headerRoute' => 'faq'
])

@section('app')
    <div class="bg-tint py-3">
        <div class="col-12 text-center">
            <h1 class="ff-catamaran my-1 my-md-2">< <span class="typed"></span> ></h1>
            <p class="ff-catamaran">Never forgets a thing</p>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <div class="p-2 bg-tint-light rounded m-1">Over {{ $faqs->count() }} questions</div>
                <div class="p-2 bg-tint-light rounded m-1">Over {{ count($uniqueTag) }} categories</div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="p-2 rounded m-1 shadow btn btn-outline-primary bg-gradient ff-catamaran" type="button"
                    data-bs-toggle="modal" data-bs-target="#addFaqModal">
                    Add your dokko
                </button>
                <div class="modal fade" id="addFaqModal" tabindex="-1" aria-labelledby="addFaqModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add a frequently forgotten question</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="question"
                                            placeholder="{{ __('Frequently forgotten question') }}" required>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="answer"
                                                placeholder="{{ __('Frequently forgotten answer') }}" required></textarea>
                                            <label for="answer">{{ __('Frequently forgotten answer') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="tag"
                                            placeholder="{{ __('Category') }}" required>
                                    </div>
                                </div>
                                <h6 class="text-danger my-1">* One FFQ should contain only one short information.</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="addFfq(this)" class="btn btn-primary">Save dokko</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10 col-md-6 mx-auto">
            <input type="text" id="search" class="form-control p-md-3" placeholder="&#xf002; Search for questions..."
                style="font-family:Arial, FontAwesome">
        </div>
    </div>
    <div class="container my-4">
        <div class="row m-1">
            <div class="col-lg-10 col-xl-8 accordion" id="accordionPanelsStayOpen">
                @foreach ($faqs as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button ff-merriweather" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ Str::slug($faq->question, '_') . $faq->id }}" aria-expanded="true"
                                aria-controls="{{ Str::slug($faq->question, '_') . $faq->id }}">
                                {{ $loop->index + 1 . '. ' . $faq->question }}
                            </button>
                        </h2>
                        <div id="{{ Str::slug($faq->question, '_') . $faq->id }}" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <pre class="ff-source-code">{{ $faq->answer }}</pre>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                $('.accordion-collapse').removeClass('show');
                var value = $(this).val().toLowerCase();
                $("button.accordion-button").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            new Typed('.typed', {
                strings: ['Frequently asked dokko'],
                typeSpeed: 100,
                loop: true,
                cursorChar: '',
            });

            hljs.highlightAll();
        });
    </script>
@endsection