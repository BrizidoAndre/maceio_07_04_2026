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
{{$slot}}
<script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
@stack('scripts')
</html>
