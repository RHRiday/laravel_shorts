<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>{{ $title }}</title>


    {{-- styles --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/highlightjs.css') }}">

    {{-- icons --}}
    <script src="https://kit.fontawesome.com/43b42e8e8a.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand ff-maven" href="{{ route($headerRoute) }}">
                {{ $title }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach ($sites as $site)
                        @if ($site->name != $title)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route($site->route) }}">{{ $site->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @if ($errors->any())
                        <li class="nav-item">
                            <span class="text-danger nav-link" role="alert">
                                <strong>{{ __('Action failed') }}</strong>
                            </span>
                        </li>
                    @endif
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item my-1 mx-lg-1 my-lg-0">
                                <a class="btn btn-sm px-2 border-dark nav-link" data-bs-toggle="modal"
                                    data-bs-target="#login_modal">
                                    {{ __('Login') }}
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="loginModalLabel"
                                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header card-header">
                                                <h5 class="modal-title" id="loginModalLabel">Login to your account</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('login') }}"
                                                    class="col-12 col-md-8 mx-auto">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-12 mb-3">
                                                            <input type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email') }}"
                                                                placeholder="{{ __('Email address') }}" required
                                                                autocomplete="email" autofocus>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-12 mb-3">
                                                            <input type="password" name="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                placeholder="{{ __('Password') }}" required>
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary order-2">
                                                            {{ __('Login') }}
                                                        </button>

                                                        @if (Route::has('password.request'))
                                                            <a class="btn btn-link order-1"
                                                                href="{{ route('password.request') }}">
                                                                {{ __('Forgot Your Password?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item my-1 mx-lg-1 my-lg-0">
                                <a class="btn btn-sm px-2 border-dark nav-link" data-bs-toggle="modal"
                                    data-bs-target="#register_modal">
                                    {{ __('Register') }}
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="register_modal" tabindex="-1"
                                    aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static"
                                    data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header card-header">
                                                <h5 class="modal-title" id="loginModalLabel">Register an account</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('register') }}"
                                                    class="col-12 col-md-8 mx-auto">
                                                    @csrf

                                                    <div class="form-group row mb-2">
                                                        <div class="col-12">
                                                            <input id="name" type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                placeholder="{{ __('Your name') }}" name="name"
                                                                value="{{ old('name') }}" required autocomplete="name"
                                                                autofocus>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-2">
                                                        <div class="col-12">
                                                            <input type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email') }}" required
                                                                autocomplete="email"
                                                                placeholder="{{ __('Email address') }}">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-2">
                                                        <div class="col-12">
                                                            <input type="password"
                                                                placeholder="{{ __('Password (6 to 20 characters)') }}"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password" required autocomplete="new-password">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-2">
                                                        <div class="col-12">
                                                            <input id="password-confirm" type="password"
                                                                class="form-control" name="password_confirmation" required
                                                                autocomplete="new-password"
                                                                placeholder="{{ __('Confirm password') }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Sign Up') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-center" href="#" id="userDropdown" role="button">
                                <i class="far fa-user-circle align-middle me-1"></i><span
                                    class="me-2 small">{{ Auth::user()->name }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm px-2 border-dark nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('app')

    <footer class="bg-tint-light mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <a class="d-inline-flex align-items-center mb-2 link-dark text-decoration-none" href="/">
                        <span class="fs-5 ff-maven">&copy; Rifat Hossen Riday</span>
                    </a>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2">Designed and built with the motivation to improve my skills and save
                            information that I gather along the along the way.
                        </li>
                        <li class="mb-2">Currently v1.0.4</li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 offset-lg-1 mb-3">
                    <h5 class="ff-catamaran">Links</h5>
                    <ul class="list-unstyled">
                        @foreach ($sites as $site)
                            <li class="mb-2"><a class="nav-link p-0"
                                    href="{{ route($site->route) }}">{{ $site->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    {{-- scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

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
    <script src="{{ asset('js/ajax.js') }}"></script>
</body>

</html>
