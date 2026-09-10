<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dash.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap-icons.min.css')}}">
    @stack('styles')
    <title>Ufood</title>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">uFood</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('public.register')}}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <p class="text-white my-0 me-3">{{auth()->user()->name}}</p>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{route('logout')}}">Logout</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
{{$slot}}
<script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
@stack('scripts')
</body>
</html>
