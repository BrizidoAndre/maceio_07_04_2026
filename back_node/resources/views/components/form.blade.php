@props([
    'method' => 'get'
])
@php
    $shoudBePost = $method !== 'get';
@endphp
<form method="{{$shoudBePost ? 'post' : 'get'}}" {{$attributes->merge()}}>
    @if($shoudBePost)
        @csrf
        @method($method)
    @endif
    {{$slot}}
</form>
